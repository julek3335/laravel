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
        if(env('FILESYSTEM_DISK') == 'public')
        {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
            Storage::disk('public')->makeDirectory('companys_photos');
            $photo = $faker->image('storage'.public_path('companys_photos'), 640, 480, ['logo',],false);
        }else{
            $photo = fake()->randomElement(['01ca5209d681bc2943c11c0bc47df650.jpg','0a337a7281c02d1e7e5cef418cf08162.jpg','3d1f48c5fdc02ea53a447fbe16a5702e.jpg','4b3b9fe3cc68649a30794e3c3c1364b2.jpg','4d7ca07adbb2f5f95d80e5237a8348d0.jpg']);
        }
        
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(2),
            'phone_number' => fake()->randomNumber(9, true),
            'address' => fake()->address(),
            'photo' => $photo,
        ];
    }
}
