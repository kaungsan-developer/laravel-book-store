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

            "user_id" => rand(1, 2),
            "name" => "admin",
            "phone" => fake()->unique()->phoneNumber(),
            "total_price" => rand(5000, 10000),
            "address" => fake()->address(),
            "note" => $this->faker->paragraph(),
            "qty" => rand(1, 10),
        ];
    }
}
