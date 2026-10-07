<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name,
            'quantity'=>fake()->numberBetween(1,100),
            'image'=>fake()->imageUrl,
            'price'=>fake()->numberBetween(1,100),
            'details'=>fake()->words(20) 
        ];
    }
}
