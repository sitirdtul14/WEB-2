<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Koperasi',
                'email' => 'admin@koperasi.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anggota 1',
                'email' => 'anggota1@koperasi.com',
                'password' => Hash::make('anggota123'),
                'role' => 'anggota',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
