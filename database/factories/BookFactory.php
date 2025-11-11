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
            'title' => $this->faker->catchPhrase(3),
            'published_year' => $this->faker->year(),
            'genre' => $this->faker->randomElement(['Fiksi', 'Non-Fiksi', 'Romance', 'Misteri', 'Fantasi', 'Sci-Fi', 'Biografi', 'Sejarah', 'Sains', 'Teknologi']),
            'author_id' => \App\Models\Author::factory(),
            // default jika tidak override

        ];
    }
}
