<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'rating' => fake()->numberBetween(1, 5),
            'description' => fake()->paragraph(),
            'pages' => fake()->numberBetween(100, 500),
            'isbn' => fake()->isbn13()
        ];
    }
}
