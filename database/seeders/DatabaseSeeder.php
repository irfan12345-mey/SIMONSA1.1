<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // HANYA panggil seeder buatan kita
        $this->call([
            PenggunaSeeder::class,
        ]);
    }
}