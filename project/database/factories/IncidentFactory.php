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
        if(env('FILESYSTEM_DISK') == 'public')
        {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
            Storage::disk('public')->makeDirectory('incidents_photos');
            $photo = $faker->image('storage'.public_path('incidents_photos'), 640, 480, ['car','crash'],false);
        }else{
            $photo = fake()->randomElement(['0b0cf0e3bd95d4d905c416266fef40af.jpg','0bfad50648fb78295b8f6223829e4716.jpg','0c0c8e825c27399898245dda1376c3e4.jpg','0c1e3ab21247183e6a37fe3127de5252.jpg','0c437e63efa68894811b95cf20e06d30.jpg']);
        }
        return [
            'date' => fake()->date(),
            'description' => fake()->paragraph(2),
            'photo' => $photo, 
            'status' => fake()->randomElement(['resolved','in_progress','unprocessed']),
            'address' => fake()->address(),
        ];

    }
}
