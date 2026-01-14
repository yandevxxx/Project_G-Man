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
        // Tabel untuk menyimpan data cache aplikasi
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Kunci identifikasi cache
            $table->mediumText('value'); // Nilai cache yang disimpan
            $table->integer('expiration'); // Waktu kadaluarsa cache
        });

        // Tabel untuk mekanisme locking cache (menghindari race condition)
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Kunci lock
            $table->string('owner'); // Pemilik lock (identifier)
            $table->integer('expiration'); // Waktu kadaluarsa lock
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
