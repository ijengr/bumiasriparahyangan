<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'type' => 'Type ' . $this->faker->randomElement(['A','B','C']),
            'land_area' => $this->faker->numberBetween(60,200),
            'floor_area' => $this->faker->numberBetween(40,180),
            'bedrooms' => $this->faker->numberBetween(1,5),
            'bathrooms' => $this->faker->numberBetween(1,4),
            'parking' => $this->faker->numberBetween(0,2),
            'built_year' => $this->faker->numberBetween(2000,2025),
            'price' => $this->faker->numberBetween(300000000,1500000000),
            'image' => 'samples/unit1.svg',
            'description' => $this->faker->paragraph(),
        ];
    }
}
