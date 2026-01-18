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
                'name' => 'PT. Indofood Sukses Makmur',
                'contact_person' => 'Budi Sudarsono',
                'phone' => '+62 812 1111 2222',
                'email' => 'budi@indofood.com',
                'address' => 'Sudirman Plaza, Jakarta',
            ],
            [
                'name' => 'PT. Mayora Indah Tbk',
                'contact_person' => 'Siti Aminah',
                'phone' => '+62 821 3333 4444',
                'email' => 'siti@mayora.com',
                'address' => 'Jl. Tomang Raya, Jakarta Barat',
            ],
            [
                'name' => 'Unilever Indonesia',
                'contact_person' => 'Andi Wijaya',
                'phone' => '+62 813 5555 6666',
                'email' => 'andi@unilever.com',
                'address' => 'BSD City, Tangerang',
            ],
            [
                'name' => 'PT. Matahari Department Store',
                'contact_person' => 'Rina Melati',
                'phone' => '+62 856 7777 8888',
                'email' => 'rina@matahari.com',
                'address' => 'Lippo Village, Tangerang',
            ],
            [
                'name' => 'PT. Erajaya Swasembada',
                'contact_person' => 'Joko Susilo',
                'phone' => '+62 811 9999 0000',
                'email' => 'joko@erajaya.com',
                'address' => 'Jl. Bandengan Selatan, Jakarta',
            ],
        ];

        // Loop dan simpan setiap supplier ke database
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
