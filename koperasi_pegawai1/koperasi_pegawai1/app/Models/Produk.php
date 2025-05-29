<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['kode', 'nama', 'deskripsi', 'harga', 'stok', 'jenis_produk_id'];

    public function jenisProduk()
    {
        return $this->belongsTo(Jenis_produk::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(Detail_pesanan::class);
    }
}
