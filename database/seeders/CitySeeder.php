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
            'slug' => 'bandung'
        ]);

        City::create([
            'name' => 'Jakarta',
            'slug' => 'jakarta'
        ]);

        City::create([
            'name' => 'Surabaya',
            'slug' => 'surabaya'
        ]);

        City::create([
            'name' => 'Banten',
            'slug' => 'banten'
        ]);

        City::create([
            'name' => 'Aceh',
            'slug' => 'aceh'
        ]);

        City::create([
            'name' => 'Jaya Pura',
            'slug' => 'jaya-pura'
        ]);
        
        City::create([
            'name' => 'Pontianak',
            'slug' => 'pontianak'
        ]);
        // City::factory(2)->create();
    }
}
