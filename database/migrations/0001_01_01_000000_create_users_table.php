<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel untuk menyimpan data utama pengguna (users)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->string('name'); // Nama lengkap pengguna
            $table->string('email')->unique(); // Alamat email unik
            $table->enum('role', ['user', 'admin'])->default('user'); // Peran pengguna (user atau admin)
            $table->string('jenis_kelamin')->nullable(); // Jenis kelamin pengguna (boleh kosong)
            $table->string('pekerjaan')->nullable(); // Pekerjaan pengguna (boleh kosong)
            $table->text('alamat')->nullable(); // Alamat tempat tinggal pengguna (boleh kosong)
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email
            $table->string('password'); // Kata sandi terenkripsi
            $table->rememberToken(); // Token untuk fitur "remember me"
            $table->timestamps(); // Kolom created_at dan updated_at
        });

        // Tabel untuk menyimpan token reset kata sandi
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email sebagai primary key
            $table->string('token'); // Token reset password
            $table->timestamp('created_at')->nullable(); // Waktu pembuatan token
        });

        // Tabel untuk menyimpan data session pengguna yang sedang aktif
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID session sebagai primary key
            $table->foreignId('user_id')->nullable()->index(); // ID pengguna yang terkait dengan session
            $table->string('ip_address', 45)->nullable(); // Alamat IP pengguna
            $table->text('user_agent')->nullable(); // Informasi browser/perangkat pengguna
            $table->longText('payload'); // Data session
            $table->integer('last_activity')->index(); // Waktu aktivitas terakhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
