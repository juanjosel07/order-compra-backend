<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => $this->faker->name(),
            'order_date' => now(),
            'payment_method' => 'Efectivo',
            'discount' => '0',
            'total' => '1000',
            'observations' => $this->faker->sentence(),
        ];
    }


}
