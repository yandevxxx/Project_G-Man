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
        // Tabel untuk mencatat transaksi pembelian produk oleh pengguna
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke pembeli (users)
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relasi ke produk yang dibeli
            $table->integer('quantity'); // Jumlah barang yang dibeli
            $table->decimal('price', 12, 2); // Harga satuan saat transaksi dilakukan
            $table->decimal('total_amount', 12, 2); // Total nilai transaksi (jumlah x harga)
            $table->string('payment_type')->nullable(); // Tipe pembayaran (QRIS, Mandiri, BRI)
            $table->string('payment_proof')->nullable(); // Nama file bukti pembayaran (boleh kosong)
            $table->string('status')->default('completed'); // Status transaksi (misal: pending, completed, rejected)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
