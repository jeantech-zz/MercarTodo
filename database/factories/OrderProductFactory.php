<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomElement([1, 2]),
            'quantity' => $this->faker->numberBetween($min = 3100000, $max = 3150000),
            'amount' => $this->faker->numberBetween($min = 3100000, $max = 3150000),
            'order_id' => $this->faker->randomElement([1, 2]),
        ];
    }
}
