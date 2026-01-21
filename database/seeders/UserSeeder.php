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
            'name' => 'Admin System',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Chief Operations Officer',
            'alamat' => 'Sudirman Central Business District, Tower 1, Jakarta',
        ]);

        User::create([
            'name' => 'User System',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Chief Operations Officer',
            'alamat' => 'Sudirman Central Business District, Tower 1, Jakarta',
        ]);
    }
}
