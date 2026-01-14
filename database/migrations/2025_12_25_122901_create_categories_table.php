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
        // Tabel untuk mengkategorikan produk
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->string('name'); // Nama kategori produk (misal: Suku Cadang, Alat Bengkel)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
