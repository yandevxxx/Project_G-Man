<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $clothing = Category::where('name', 'Clothing')->first();

        if ($electronics) {
            Product::create([
                'category_id' => $electronics->id,
                'name' => 'Smartphone X',
                'description' => 'Latest model smartphone with high-res camera.',
                'price' => 799.00,
                'stock' => 50,
            ]);

            Product::create([
                'category_id' => $electronics->id,
                'name' => 'Laptop Pro',
                'description' => 'High performance laptop for professionals.',
                'price' => 1299.00,
                'stock' => 30,
            ]);
        }

        if ($clothing) {
            Product::create([
                'category_id' => $clothing->id,
                'name' => 'Classic T-Shirt',
                'description' => 'Comfortable cotton t-shirt.',
                'price' => 19.99,
                'stock' => 100,
            ]);

            Product::create([
                'category_id' => $clothing->id,
                'name' => 'Denim Jeans',
                'description' => 'Stylish and durable denim jeans.',
                'price' => 49.99,
                'stock' => 75,
            ]);
        }
    }
}
