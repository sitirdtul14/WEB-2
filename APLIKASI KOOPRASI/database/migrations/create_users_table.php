<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Nama lengkap pengguna
            $table->string('email')->unique(); // Email harus unik
            $table->string('password'); // Password terenkripsi
            $table->enum('role', ['admin', 'anggota'])->default('anggota'); // Peran dalam koperasi
            $table->timestamp('email_verified_at')->nullable(); // Untuk verifikasi email jika diperlukan
            $table->timestamps(); // Kolom created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
