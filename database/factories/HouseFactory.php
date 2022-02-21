<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'price' => "int", 'bedrooms' => "int", 'bathrooms' => "int", 'storeys' => "int", 'garages' => "int"])]
    public function definition(): array
    {
        return [
            'name' => $this->faker->address(),
            'price' => $this->faker->randomNumber(),
            'bedrooms' => $this->faker->numberBetween(1, 12),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'storeys' => $this->faker->numberBetween(1, 3),
            'garages' => $this->faker->numberBetween(1, 4)
        ];
    }
}
