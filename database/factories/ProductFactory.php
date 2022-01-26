<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numberBetween($min = 11000, $max = 12000),
            'name' => $this->faker->name(),
            'description' => $this->faker->name(),
            'price' =>  $this->faker->numberBetween($min = 11000, $max = 2000000),
            'quantity' =>  $this->faker->numberBetween($min = 1, $max = 20),
            'disable_at' => $this->faker->randomElement([null, now()]),
            'image' => '$this->faker->imageUrl(400, 240)',
        ];
    }
}
