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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'isbn' => $this->faker->isbn10(),
            'country' => $this->faker->country(),
            'number_of_pages' => $this->faker->numberBetween(100, 400),
            'publisher' => $this->faker->company(),
            'release_date' => $this->faker->date,
        ];
    }
}