<?php

namespace Database\Seeders;

use App\Models\CarService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarService::create([
            'name' => "Gold Wash",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);

        CarService::create([
            'name' => "Fix Paint",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);

        CarService::create([
            'name' => "Interiors",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);

        CarService::create([
            'name' => "Exteriors",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);

        CarService::create([
            'name' => "3D Coating",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);

        CarService::create([
            'name' => "Kaca Film",
            'price' => fake()->numberBetween(40000, 800000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ]);
    }
}
