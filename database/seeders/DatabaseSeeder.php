<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Kategori::create([
            'name' => 'Pelayanan'
        ]);
        Kategori::create([
            'name' => 'Waktu'
        ]);
        Kategori::create([
            'name' => 'Berkendara'
        ]);
        Kategori::create([
            'name' => 'Keselamatan'
        ]);
        Kategori::create([
            'name' => 'Lain-Lain'
        ]);
    }
}
