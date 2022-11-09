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
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
        Storage::disk('public')->makeDirectory('insurance_photos');

        return [
            'policy_number' => fake()->randomNumber(5, true),
            'expiration_date' => fake()->dateTimeBetween('-5 week', '+12 week'),
            'cost' => fake()->randomNumber(3, false),
            'phone_number' => fake()->randomNumber(9, true),
            'type' => fake()->randomElement([InsuranceTypeEnum::AC, InsuranceTypeEnum::ASSISTANCE, InsuranceTypeEnum::OC, InsuranceTypeEnum::OC_AC, InsuranceTypeEnum::NNW]),
            'insurer_name' => fake()->words(1, true),
            'description' => fake()->sentence(),
            'photo' => $faker->image('storage'.public_path('insurance_photos'), 640, 480, ['recipt'],false),
            'status' => InsuranceStatusEnum::ACTIVE
        ];
    }
}
