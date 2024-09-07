<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Bandung',
        ]);

        City::create([
            'name' => 'Jakarta',
        ]);

        City::create([
            'name' => 'Surabaya',
        ]);

        City::create([
            'name' => 'Banten',
        ]);

        City::create([
            'name' => 'Aceh',
        ]);

        City::create([
            'name' => 'Jaya Pura',
        ]);

        City::create([
            'name' => 'Pontianak',
        ]);
    }
}
