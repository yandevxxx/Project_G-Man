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
        $electronics = Category::where('name', 'Electronics')->first();
        $clothing = Category::where('name', 'Clothing')->first();
        
        $supplier1 = Supplier::where('name', 'PT. Maju Jaya Elektronik')->first();
        $supplier2 = Supplier::where('name', 'CV. Berkah Textile')->first();
        $supplier4 = Supplier::where('name', 'PT. Global Tech Indonesia')->first();

        if ($electronics) {
            Product::create([
                'category_id' => $electronics->id,
                'supplier_id' => $supplier1?->id,
                'name' => 'Smartphone X',
                'description' => 'Latest model smartphone with high-res camera.',
                'price' => 7990000,
                'stock' => 50,
            ]);

            Product::create([
                'category_id' => $electronics->id,
                'supplier_id' => $supplier4?->id,
                'name' => 'Laptop Pro',
                'description' => 'High performance laptop for professionals.',
                'price' => 12990000,
                'stock' => 30,
            ]);
            
            Product::create([
                'category_id' => $electronics->id,
                'supplier_id' => $supplier1?->id,
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with long battery life.',
                'price' => 250000,
                'stock' => 120,
            ]);
        }

        if ($clothing) {
            Product::create([
                'category_id' => $clothing->id,
                'supplier_id' => $supplier2?->id,
                'name' => 'Classic T-Shirt',
                'description' => 'Comfortable cotton t-shirt.',
                'price' => 150000,
                'stock' => 100,
            ]);

            Product::create([
                'category_id' => $clothing->id,
                'supplier_id' => $supplier2?->id,
                'name' => 'Denim Jeans',
                'description' => 'Stylish and durable denim jeans.',
                'price' => 450000,
                'stock' => 75,
            ]);
            
            Product::create([
                'category_id' => $clothing->id,
                'name' => 'Casual Jacket',
                'description' => 'Lightweight jacket perfect for any season.',
                'price' => 650000,
                'stock' => 40,
            ]);
        }
    }
}
