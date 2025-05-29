<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_pesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    public $timestamps = false;

    protected $fillable = ['pesanan_id', 'produk_id', 'jumlah'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
