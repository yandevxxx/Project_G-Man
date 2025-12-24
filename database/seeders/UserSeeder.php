<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Admin G-Man',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Administrator',
            'alamat' => 'Jakarta, Indonesia',
        ]);

        User::create([
            'name' => 'Supplier G-Man',
            'email' => 'supplier@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Distributor',
            'alamat' => 'Bandung, Indonesia',
        ]);

       User::create([
            'name' => 'User G-Man',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Perempuan',
            'pekerjaan' => 'Mahasiswa',
            'alamat' => 'Surabaya, Indonesia',
        ]);
    }
}
