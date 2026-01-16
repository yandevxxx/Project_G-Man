<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

/**
 * Class SupplierSeeder
 *
 * Seeder untuk mengisi data supplier awal.
 *
 * @package Database\Seeders
 */
class SupplierSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Data sampel supplier
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
        ];

        // Loop dan simpan setiap supplier ke database
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
