<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jenis_produk extends Model
{
    use HasFactory;

    protected $table = 'jenis_produk';

    protected $fillable = ['nama', 'deskripsi'];

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
