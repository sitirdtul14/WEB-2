<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = ['status_aktif', 'pegawai_id', 'kartu_diskon_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function kartuDiskon()
    {
        return $this->belongsTo(Kartu_diskon::class);
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
