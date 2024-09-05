<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarService>
 */
class CarServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => Str::slug(fake()->name()),
            'price' => fake()->numberBetween(40000, 8000000),
            'about' => fake()->sentence(),
            'photo' => fake()->imageUrl(640, 480, 'animals', true),
            'icon' => fake()->imageUrl(640, 480, 'animals', true),
            'duration_in_hour' => fake()->numberBetween(1, 5),
        ];
    }
}
