<?php

namespace App\Http\Controllers;

use App\Models\Jenis_produk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index()
    {
        $jenisProduk = Jenis_produk::all();
        return view('jenis_produk.index', compact('jenisProduk'));
    }

    public function create()
    {
        return view('jenis_produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:45',
            'deskripsi' => 'nullable|string',
        ]);

        Jenis_produk::create($request->all());

        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function show(Jenis_produk $jenisProduk)
    {
        return view('jenis_produk.show', compact('jenisProduk'));
    }

    public function edit(Jenis_produk $jenisProduk)
    {
        return view('jenis_produk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, Jenis_produk $jenisProduk)
    {
        $request->validate([
            'nama' => 'required|string|max:45',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisProduk->update($request->all());

        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(Jenis_produk $jenisProduk)
    {
        $jenisProduk->delete();
        return redirect()->route('jenis-produk.index')->with('success', 'Jenis produk berhasil dihapus.');
    }
}
