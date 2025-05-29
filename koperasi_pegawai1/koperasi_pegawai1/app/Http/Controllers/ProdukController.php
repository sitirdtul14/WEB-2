<?php

namespace App\Http\Controllers;

use App\Models\Jenis_produk;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('jenisProduk')->get();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        $jenisProduk = Jenis_produk::all();
        return view('produk.create', compact('jenisProduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:45|unique:produk,kode',
            'nama' => 'required|string|max:45',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'jenis_produk_id' => 'required|exists:jenis_produk,id',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('jenisProduk');
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $jenisProduk = Jenis_produk::all();
        return view('produk.edit', compact('produk', 'jenisProduk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'kode' => 'required|string|max:45|unique:produk,kode,' . $produk->id,
            'nama' => 'required|string|max:45',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'jenis_produk_id' => 'required|exists:jenis_produk,id',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
