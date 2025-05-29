<?php

namespace App\Http\Controllers;

use App\Models\Detail_pesanan;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Anggota;
use App\Models\Produk;
use DB;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['anggota', 'detailPesanan.produk'])->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $produk = Produk::where('stok', '>', 0)->get();
        return view('pesanan.create', compact('anggota', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required|exists:anggota,id',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'status_bayar' => 'nullable|boolean',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            // Calculate total
            $total = 0;
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];
                $total += $produk->harga * $jumlah;
            }

            // Apply discount
            $diskon = $request->diskon ?? 0;
            $total = $total * (1 - $diskon / 100);

            // Create pesanan
            $pesanan = Pesanan::create([
                'tanggal' => $request->tanggal,
                'anggota_id' => $request->anggota_id,
                'diskon' => $diskon,
                'total' => $total,
                'status_bayar' => $request->status_bayar ?? false,
            ]);

            // Create detail pesanan
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];

                Detail_pesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produkId,
                    'jumlah' => $jumlah,
                    'harga' => $produk->harga,
                ]);

                // Update stock
                $produk->decrement('stok', $jumlah);
            }

            // Create pembayaran if status_bayar is true
            if ($request->status_bayar) {
                Pembayaran::create([
                    'pesanan_id' => $pesanan->id,
                    'jumlah_bayar' => $total,
                    'tanggal' => $request->tanggal,
                ]);
            }

            DB::commit();

            return redirect()->route('pesanan.show', $pesanan->id)
                ->with('success', 'Pemesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal membuat pemesanan: ' . $e->getMessage());
        }
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['anggota', 'detailPesanan.produk']);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $pesanan->load(['detailPesanan']);
        $anggota = Anggota::all();
        $produk = Produk::where('stok', '>', 0)->get();
        return view('pesanan.edit', compact('pesanan', 'anggota', 'produk'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required|exists:anggota,id',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'status_bayar' => 'nullable|boolean',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            // First, restore all product stocks from old details
            foreach ($pesanan->detailPesanan as $detail) {
                $produk = Produk::find($detail->produk_id);
                if ($produk) {
                    $produk->increment('stok', $detail->jumlah);
                }
            }

            // Delete old details
            $pesanan->detailPesanan()->delete();

            // Calculate new total
            $total = 0;
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];
                $total += $produk->harga * $jumlah;
            }

            // Apply discount
            $diskon = $request->diskon ?? 0;
            $total = $total * (1 - $diskon / 100);

            // Update pesanan
            $pesanan->update([
                'tanggal' => $request->tanggal,
                'anggota_id' => $request->anggota_id,
                'diskon' => $diskon,
                'total' => $total,
                'status_bayar' => $request->status_bayar ?? false,
            ]);

            // Create new detail pesanan
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];

                Detail_pesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produkId,
                    'jumlah' => $jumlah,
                    'harga' => $produk->harga,
                ]);

                // Update stock
                $produk->decrement('stok', $jumlah);
            }

            // Update or create pembayaran
            if ($request->status_bayar) {
                Pembayaran::updateOrCreate(
                    ['pesanan_id' => $pesanan->id],
                    [
                        'jumlah_bayar' => $total,
                        'tanggal' => $request->tanggal,
                    ]
                );
            } else {
                $pesanan->pembayaran()->delete();
            }

            DB::commit();

            return redirect()->route('pesanan.show', $pesanan->id)
                ->with('success', 'Pemesanan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal memperbarui pemesanan: ' . $e->getMessage());
        }
    }

    public function destroy(Pesanan $pesanan)
    {
        DB::beginTransaction();
        try {
            // Restore product stocks
            foreach ($pesanan->detailPesanan as $detail) {
                $produk = Produk::find($detail->produk_id);
                if ($produk) {
                    $produk->increment('stok', $detail->jumlah);
                }
            }

            // Delete related records
            $pesanan->detailPesanan()->delete();
            $pesanan->pembayaran()->delete();
            $pesanan->delete();

            DB::commit();

            return redirect()->route('pesanan.index')
                ->with('success', 'Pemesanan berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus pemesanan: ' . $e->getMessage());
        }
    }
}