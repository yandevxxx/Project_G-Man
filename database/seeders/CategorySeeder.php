<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategorySeeder
 *
 * Seeder untuk mengisi data kategori awal ke dalam database.
 *
 * @package Database\Seeders
 */
class CategorySeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Daftar kategori produk yang akan ditambahkan
        $categories = [
            'Makanan',
            'Minuman',
            'Pakaian',
            'Elektronik',
            'Kesehatan'
        ];

        // Loop melalui setiap item dan simpan ke database
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
