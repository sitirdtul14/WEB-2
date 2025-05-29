<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = ['nip', 'nama', 'jenis_kelamin', 'jabatan'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
