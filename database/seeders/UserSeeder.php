<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserSeeder
 *
 * Seeder untuk membuat akun pengguna default (Admin dan User Biasa).
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Alexander G. Man',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Chief Operations Officer',
            'alamat' => 'Sudirman Central Business District, Tower 1, Jakarta',
        ]);

        // Membuat akun User biasa 1
        User::create([
            'name' => 'Sarah Jean',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Perempuan',
            'pekerjaan' => 'Logistics Coordinator',
            'alamat' => 'Pakuwon City Commercial Area, Block B2, Surabaya',
        ]);

        // Membuat akun User biasa 2
        User::create([
            'name' => 'Michael Santoso',
            'email' => 'michael@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Software Engineer',
            'alamat' => 'Jl. Kebon Jeruk No. 88, Jakarta Barat',
        ]);

        // Membuat akun User biasa 3
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Perempuan',
            'pekerjaan' => 'Marketing Specialist',
            'alamat' => 'Jl. Diponegoro No. 10, Semarang',
        ]);

        // Membuat akun User biasa 4
        User::create([
            'name' => 'Bambang Pamungkas',
            'email' => 'bambang@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Production Manager',
            'alamat' => 'Jl. Slamet Riyadi No. 5, Solo',
        ]);
    }
}
