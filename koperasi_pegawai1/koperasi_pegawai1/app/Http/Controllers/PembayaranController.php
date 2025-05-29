<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('pesanan')->paginate(10);
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pesanan = Pesanan::with(['detailPesanan.produk'])->where('status_bayar', false)->get();
        return view('pembayaran.create', compact('pesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'pesanan_id' => 'required|exists:pesanan,id'
        ]);

        // Create new payment
        $pembayaran = Pembayaran::create([
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal' => $request->tanggal,
            'pesanan_id' => $request->pesanan_id
        ]);

        // Update order payment status if payment covers the amount
        $pesanan = Pesanan::find($request->pesanan_id);
        $totalPembayaran = Pembayaran::where('pesanan_id', $request->pesanan_id)->sum('jumlah_bayar');
        
        if ($totalPembayaran >= ($pesanan->total_harga - $pesanan->diskon)) {
            $pesanan->update(['status_bayar' => true]);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        $pesanan = Pesanan::all();
        return view('pembayaran.edit', compact('pembayaran', 'pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'pesanan_id' => 'required|exists:pesanan,id'
        ]);

        $pembayaran->update([
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal' => $request->tanggal,
            'pesanan_id' => $request->pesanan_id
        ]);

        // Recheck payment status for the order
        $pesanan = Pesanan::find($request->pesanan_id);
        $totalPembayaran = Pembayaran::where('pesanan_id', $request->pesanan_id)->sum('jumlah_bayar');
        
        if ($totalPembayaran >= ($pesanan->total_harga - $pesanan->diskon)) {
            $pesanan->update(['status_bayar' => true]);
        } else {
            $pesanan->update(['status_bayar' => false]);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pesanan_id = $pembayaran->pesanan_id;
        $pembayaran->delete();

        // Recheck payment status for the order
        $pesanan = Pesanan::find($pesanan_id);
        $totalPembayaran = Pembayaran::where('pesanan_id', $pesanan_id)->sum('jumlah_bayar');
        
        if ($totalPembayaran >= ($pesanan->total_harga - $pesanan->diskon)) {
            $pesanan->update(['status_bayar' => true]);
        } else {
            $pesanan->update(['status_bayar' => false]);
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus');
    }
}