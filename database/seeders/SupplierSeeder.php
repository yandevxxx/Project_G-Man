<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Maju Jaya Elektronik',
                'contact_person' => 'Budi Santoso',
                'phone' => '+62 812 3456 7890',
                'email' => 'budi@majujaya.com',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            ],
            [
                'name' => 'CV. Berkah Textile',
                'contact_person' => 'Siti Rahayu',
                'phone' => '+62 821 9876 5432',
                'email' => 'siti@berkahtextile.com',
                'address' => 'Jl. Gatot Subroto No. 45, Bandung',
            ],
            [
                'name' => 'UD. Sejahtera Mandiri',
                'contact_person' => 'Ahmad Wijaya',
                'phone' => '+62 813 5555 6666',
                'email' => 'ahmad@sejahtera.com',
                'address' => 'Jl. Diponegoro No. 78, Surabaya',
            ],
            [
                'name' => 'PT. Global Tech Indonesia',
                'contact_person' => 'Dewi Lestari',
                'phone' => '+62 856 7777 8888',
                'email' => 'dewi@globaltech.id',
                'address' => 'Jl. HR Rasuna Said No. 99, Jakarta Selatan',
            ],
            [
                'name' => 'CV. Anugrah Furniture',
                'contact_person' => 'Eko Prasetyo',
                'phone' => '+62 878 1234 5678',
                'email' => 'eko@anugrahfurniture.com',
                'address' => 'Jl. Ahmad Yani No. 56, Semarang',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
