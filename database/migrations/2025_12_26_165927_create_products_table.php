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
        // Tabel untuk mengelola data produk/barang di bengkel
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke tabel categories
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null'); // Relasi ke tabel suppliers
            $table->string('name'); // Nama produk
            $table->text('description')->nullable(); // Deskripsi lengkap produk (boleh kosong)
            $table->decimal('price', 10, 2); // Harga satuan produk
            $table->integer('stock'); // Jumlah stok tersedia
            $table->string('image')->nullable(); // Nama file gambar produk (boleh kosong)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
