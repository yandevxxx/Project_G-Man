<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 *
 * Seeder utama untuk menjalankan semua seeder lainnya secara berurutan.
 *
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Memanggil seeder lain untuk mengisi data awal aplikasi
        $this->call([
            UserSeeder::class,      // Membuat data user admin dan biasa
            CategorySeeder::class,  // Membuat data kategori
            SupplierSeeder::class,  // Membuat data supplier
            ProductSeeder::class,   // Membuat data produk (setelah kategori & supplier)
        ]);
    }
}
