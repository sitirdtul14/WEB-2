<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = ['jumlah_bayar', 'tanggal', 'pesanan_id'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
