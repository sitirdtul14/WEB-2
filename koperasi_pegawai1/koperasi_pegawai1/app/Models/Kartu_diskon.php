<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kartu_diskon extends Model
{
    use HasFactory;

    protected $table = 'kartu_diskon';

    protected $fillable = ['nama', 'deskripsi', 'persen_diskon'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
