<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])->name('anggota.show');
Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

Route::resource('jenis-produk', JenisProdukController::class);
Route::resource('produk', ProdukController::class);
Route::resource('pesanan', PesananController::class);
Route::resource('pembayaran', PembayaranController::class);

