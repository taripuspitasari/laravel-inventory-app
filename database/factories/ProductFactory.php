<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(mt_rand(2, 4), true),
            'description' => fake()->sentence(),
            'category_id' => fake()->numberBetween(1, 3),
            'stock' => fake()->numberBetween(1, 100),
            'price' => fake()->numberBetween(500000, 1000000),
        ];
    }
}
