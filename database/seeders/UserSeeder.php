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
            'name' => 'Alexander G. Man',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Chief Operations Officer',
            'alamat' => 'Sudirman Central Business District, Tower 1, Jakarta',
        ]);

        User::create([
            'name' => 'Sarah Jean',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'jenis_kelamin' => 'Perempuan',
            'pekerjaan' => 'Logistics Coordinator',
            'alamat' => 'Pakuwon City Commercial Area, Block B2, Surabaya',
        ]);
    }
}
