<?php

namespace Database\Factories;

use App\Enums\InsuranceStatusEnum;
use App\Enums\InsuranceTypeEnum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
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
            Storage::disk('public')->makeDirectory('insurance_photos');
            $photo = $faker->image('storage'.public_path('insurance_photos'), 640, 480, ['recipt'],false);
        }else{
            $photo = fake()->randomElement(['0a19ff44aa37f4dd17aa4ee9263579de.jpg','0a49f5ad4a2de74ab5f2b6ca8b6545eb.jpg','0a98331f872f4e7503fd05fa19054658.jpg','0afabbfc96eb8576cb60c2aa7f3a95a4.jpg','0b643b264e4844225881529f4bfb6a3e.jpg']);
        }

        return [
            'policy_number' => fake()->randomNumber(5, true),
            'expiration_date' => fake()->dateTimeBetween('-5 week', '+12 week'),
            'cost' => fake()->randomNumber(3, false),
            'phone_number' => fake()->randomNumber(9, true),
            'type' => fake()->randomElement([InsuranceTypeEnum::AC, InsuranceTypeEnum::ASSISTANCE, InsuranceTypeEnum::OC, InsuranceTypeEnum::OC_AC, InsuranceTypeEnum::NNW]),
            'insurer_name' => fake()->words(1, true),
            'description' => fake()->sentence(),
            'photo' => $photo,
            'status' => InsuranceStatusEnum::ACTIVE
        ];
    }
}
