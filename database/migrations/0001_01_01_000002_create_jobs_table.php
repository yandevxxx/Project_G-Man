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
        // Tabel untuk antrian pekerjaan (queue jobs)
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->string('queue')->index(); // Nama antrian
            $table->longText('payload'); // Data pekerjaan dalam format JSON
            $table->unsignedTinyInteger('attempts'); // Jumlah percobaan eksekusi
            $table->unsignedInteger('reserved_at')->nullable(); // Waktu reservasi pekerjaan oleh worker
            $table->unsignedInteger('available_at'); // Waktu pekerjaan tersedia untuk dieksekusi
            $table->unsignedInteger('created_at'); // Waktu pembuatan entri pekerjaan
        });

        // Tabel untuk memantau batch pekerjaan yang dijalankan sekaligus
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary(); // ID Batch (string)
            $table->string('name'); // Nama batch
            $table->integer('total_jobs'); // Total pekerjaan dalam satu batch
            $table->integer('pending_jobs'); // Jumlah pekerjaan yang belum selesai
            $table->integer('failed_jobs'); // Jumlah pekerjaan yang gagal
            $table->longText('failed_job_ids'); // ID-ID pekerjaan yang gagal
            $table->mediumText('options')->nullable(); // Opsi konfigurasi batch
            $table->integer('cancelled_at')->nullable(); // Waktu batch dibatalkan
            $table->integer('created_at'); // Waktu pembuatan batch
            $table->integer('finished_at')->nullable(); // Waktu batch selesai diproses
        });

        // Tabel untuk mencatat pekerjaan yang gagal diproses berkali-kali
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // ID Primary Key
            $table->string('uuid')->unique(); // UUID unik untuk pekerjaan
            $table->text('connection'); // Nama koneksi queue (misal: redis, database)
            $table->text('queue'); // Nama antrian
            $table->longText('payload'); // Data pekerjaan
            $table->longText('exception'); // Pesan error/exception saat gagal
            $table->timestamp('failed_at')->useCurrent(); // Waktu kegagalan tercatat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
