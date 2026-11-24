<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::create([
            'nama' => 'Administrator',
            'username' => 'farhan',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_akun' => 'aktif',
        ]);
        Pengguna::create([
            'nama' => 'Administrator',
            'username' => 'rifal',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status_akun' => 'aktif',
        ]);
    }
}
