<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pegawai;
use App\Models\Kartu_diskon;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with(['pegawai', 'kartuDiskon'])->get();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        $pegawai = Pegawai::all();
        $kartuDiskon = Kartu_diskon::all();
        return view('anggota.create', compact('pegawai', 'kartuDiskon'));
    }

    public function store(Request $request)
    {
        // Validasi data pegawai
        $validatedPegawai = $request->validate([
            'nip' => 'required|unique:pegawai',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required'
        ]);

        // Buat pegawai baru
        $pegawai = Pegawai::create($validatedPegawai);

        // Buat anggota baru
        $anggota = Anggota::create([
            'pegawai_id' => $pegawai->id,
            'status_aktif' => true, // default aktif
            'kartu_diskon_id' => null // bisa diisi null dulu
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        $anggota->load(['pegawai', 'kartuDiskon']);
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        $pegawai = Pegawai::all();
        $kartuDiskon = Kartu_diskon::all();
        return view('anggota.edit', compact('anggota', 'pegawai', 'kartuDiskon'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:pegawai,nip,' . $anggota->pegawai->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required|string|max:255',
            'status_aktif' => 'required|boolean'
        ]);

        // Update data pegawai
        $anggota->pegawai->update($validated);

        // Update status anggota
        $anggota->update(['status_aktif' => $request->status_aktif]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
