<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarStore>
 */
class CarStoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'thumbnail' => fake()->imageUrl(640, 480, 'animals', true),
            'is_open' => fake()->boolean(),
            'is_full' => fake()->boolean(),
            'addresss' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'cs_name' => fake()->name(),
            'city_id' => City::factory(),
        ];
    }
}
