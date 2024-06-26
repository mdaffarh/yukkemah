<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
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
        User::create([
            'username' => 'admin',
            'password' => '3001',
            'role' => 'admin',
            'name' => 'Admin',
            'gender' => 'Laki-laki',
            'email' => 'admin@gmail.com',
            'address' => 'Depok'
        ]);

        // Kategori
        $categories = [
            [
                'name' => 'Sepatu'
            ],
            [
                'name' => 'Tas'
            ],
            [
                'name' => 'Tenda'
            ],
            [
                'name' => 'Peralatan Masak'
            ],
            [
                'name' => 'Pakaian'
            ],
            [
                'name' => 'Lainnya'
            ],
        ];

        foreach ($categories as $c) {
            Category::create($c);
        }

        // Brand
        $brands = [
            [
                'name' => 'Eiger'
            ],
            [
                'name' => 'Nike'
            ],
            [
                'name' => 'New Balance'
            ],
            [
                'name' => 'Adidas'
            ],
            [
                'name' => 'Hike  Run'
            ],
            [
                'name' => 'Unbrand'
            ],
        ];

        foreach ($brands as $b) {
            Brand::create($b);
        }

        // Equipment::factory(10)->create();
    }
}
