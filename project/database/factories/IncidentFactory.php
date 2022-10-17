<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
        Storage::disk('public')->makeDirectory('incidents_photos');
        return [
            'date' => fake()->date(),
            'description' => fake()->paragraph(2),
            'photo' => $faker->image('storage'.public_path('incidents_photos'), 640, 480, ['car','crash'],false), 
            'status' => fake()->randomElement(['resolved','in_progress','unprocessed']),
            'address' => fake()->address(),
        ];

    }
}
