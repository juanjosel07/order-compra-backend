<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
	protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
			'name' => $this->faker->words(2, true),
			'unit_price' => $this->faker->randomFloat(2, 500000, 3000000),
			'iva' => $this->faker->numberBetween(10, 30), // ← valor entero entre 10 y 30
        ];
    }
}
