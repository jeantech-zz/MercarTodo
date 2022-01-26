<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2]),
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->safeEmail(),
            'customer_mobile' => $this->faker->numberBetween($min = 3100000, $max = 3150000),
            'total' => $this->faker->numberBetween($min = 10000, $max = 50000),
            'currency' => 'COP',
            'status' => $this->faker->randomElement(["INPROCESS","INPROCESSPAY","REJECTED","SUCCESS"]),
        ];
    }
}
