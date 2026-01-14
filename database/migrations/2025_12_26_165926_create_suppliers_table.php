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
        // Tabel untuk mengelola data pemasok (suppliers) barang
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->string('name'); // Nama perusahaan/pemasok
            $table->string('contact_person')->nullable(); // Nama penanggung jawab (boleh kosong)
            $table->string('phone')->nullable(); // Nomor telepon pemasok (boleh kosong)
            $table->string('email')->nullable(); // Alamat email pemasok (boleh kosong)
            $table->text('address')->nullable(); // Alamat lengkap pemasok (boleh kosong)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
