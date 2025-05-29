<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        $produk = Produk::all();
        $pemesanan = Pesanan::all();
        $transaksi = Pembayaran::all();

        return view('dashboard', compact('anggota', 'produk', 'pemesanan', 'transaksi'));
    }
}
