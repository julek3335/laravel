<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => fake()->date(),
            'description' => fake()->paragraph(),
            'photo' => "photo1.jpg",
            'status' => fake()->randomElement(['resolved','in_progress','unprocessed']),
            'address' => fake()->address(),
        ];

    }
}
