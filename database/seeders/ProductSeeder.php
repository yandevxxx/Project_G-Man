<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->pluck('id', 'name');
        $suppliers = Supplier::all()->pluck('id', 'name');

        $products = [
            [
                'name' => 'Smartphone X',
                'category' => 'Electronics',
                'supplier' => 'PT. Maju Jaya Elektronik',
                'price' => 7990000,
                'stock' => 50,
                'description' => 'Latest model smartphone with high-res camera.',
                'image' => 'products/smartphone-x.png'
            ],
            [
                'name' => 'Classic T-Shirt',
                'category' => 'Clothing',
                'supplier' => 'CV. Berkah Textile',
                'price' => 150000,
                'stock' => 100,
                'description' => 'Comfortable cotton t-shirt.',
                'image' => 'products/classic-tshirt.png'
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'category_id' => $categories[$item['category']] ?? $categories->first(),
                'supplier_id' => $suppliers[$item['supplier']] ?? null,
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'image' => $item['image'] ?? null,
            ]);
        }
    }
}
