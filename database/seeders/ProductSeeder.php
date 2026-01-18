<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

/**
 * Class ProductSeeder
 *
 * Seeder untuk mengisi data produk awal sebagai sampel.
 *
 * @package Database\Seeders
 */
class ProductSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Mengambil ID untuk semua kategori dan supplier agar bisa dipetakan
        $categories = Category::all()->pluck('id', 'name');
        $suppliers = Supplier::all()->pluck('id', 'name');

        // Data sampel produk
        $products = [
            [
                'name' => 'Indomie Goreng Original',
                'category' => 'Makanan',
                'supplier' => 'PT. Indofood Sukses Makmur',
                'price' => 3500,
                'stock' => 500,
                'description' => 'Mi instan goreng rasa original yang melegenda.',
                'image' => 'products/indomie.png'
            ],
            [
                'name' => 'Teh Botol Sosro 450ml',
                'category' => 'Minuman',
                'supplier' => 'PT. Mayora Indah Tbk',
                'price' => 6000,
                'stock' => 200,
                'description' => 'Minuman teh melati dalam kemasan botol plastik.',
                'image' => 'products/tehbotol.png'
            ],
            [
                'name' => 'Kaos Polos Cotton Combed 30s',
                'category' => 'Pakaian',
                'supplier' => 'PT. Matahari Department Store',
                'price' => 55000,
                'stock' => 100,
                'description' => 'Kaos polos premium bahan lembut dan adem.',
                'image' => 'products/kaos.png'
            ],
            [
                'name' => 'Kopi Kapal Api 165g',
                'category' => 'Makanan',
                'supplier' => 'PT. Mayora Indah Tbk',
                'price' => 15000,
                'stock' => 150,
                'description' => 'Kopi bubuk hitam mantap dengan aroma khas.',
                'image' => 'products/kopi.png'
            ],
            [
                'name' => 'Smartphone Galaxy A54',
                'category' => 'Elektronik',
                'supplier' => 'PT. Erajaya Swasembada',
                'price' => 5999000,
                'stock' => 25,
                'description' => 'Smartphone 5G dengan kamera mantap dan layar jernih.',
                'image' => 'products/samsung.png'
            ],
        ];

        // Loop melalui data produk dan simpan ke database
        foreach ($products as $item) {
            Product::create([
                'category_id' => $categories[$item['category']] ?? $categories->first(), // Ambil ID kategori berdasarkan nama
                'supplier_id' => $suppliers[$item['supplier']] ?? null,                  // Ambil ID supplier berdasarkan nama
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'image' => $item['image'] ?? null,
            ]);
        }
    }
}
