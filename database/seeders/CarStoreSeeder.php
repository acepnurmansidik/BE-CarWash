<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CarStore;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([CitySeeder::class]);
        CarStore::factory(15)->recycle([City::all()])->create();
    }
}
