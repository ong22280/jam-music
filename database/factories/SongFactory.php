<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Song>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'artist' => $this->faker->name(),
            'album' => $this->faker->sentence(3),
            'duration' => $this->faker->numberBetween(120, 600),
            'youtube_id' => $this->faker->regexify('[a-zA-Z0-9_-]{11}'),
        ];
    }
}
