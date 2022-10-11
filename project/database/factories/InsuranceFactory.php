<?php

namespace Database\Factories;

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
        return [
            'policy_number' => fake()->randomNumber(5, true),
            'expiration_date' => fake()->dateTimeBetween('-5 week', '+12 week'),
            'cost' => fake()->randomNumber(3, false),
            'phone_number' => fake()->randomNumber(9, true),
        ];
    }
}
