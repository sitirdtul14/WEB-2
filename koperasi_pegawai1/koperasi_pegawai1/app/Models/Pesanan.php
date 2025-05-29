<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = ['tanggal', 'diskon', 'status_bayar', 'anggota_id'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(Detail_pesanan::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
