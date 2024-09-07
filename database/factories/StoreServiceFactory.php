<?php

namespace Database\Factories;

use App\Models\CarService;
use App\Models\CarStore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreService>
 */
class StoreServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_service_id' => CarService::factory(),
            'car_store_id' => CarStore::factory(),
        ];
    }
}
