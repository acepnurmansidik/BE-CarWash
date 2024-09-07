<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CarStore;
use App\Models\CarService;
use App\Models\StoreService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Car Care Owner',
            'email' => 'carcare.owner@gmail.com',
            'password' => Hash::make('admin1234'),
        ]);

        $this->call([CarServiceSeeder::class, CarStoreSeeder::class]);
        StoreService::factory(25)->recycle([
            CarService::all(),
            CarStore::all()
        ])->create();
    }
}
