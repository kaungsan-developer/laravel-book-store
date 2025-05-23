<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => ucwords($this->faker->word),
            "aurthor" => ucwords($this->faker->word),
            "category_id" => rand(1, 10),
            "price" => rand(2000, 10000),
            "count" => rand(10, 100),

        ];
    }
}
