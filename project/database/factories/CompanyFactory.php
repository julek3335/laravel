<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
        // Storage::disk('public')->makeDirectory('companys_photos');
        
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(2),
            'phone_number' => fake()->randomNumber(9, true),
            'address' => fake()->address(),
            // 'photo' => $faker->image('storage'.public_path('companys_photos'), 640, 480, ['logo',],false),
        ];
    }
}
