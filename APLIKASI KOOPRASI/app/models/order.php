<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['kode_pesanan', 'nama_pelanggan', 'produk', 'jumlah', 'total_harga', 'tanggal_pesanan'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
