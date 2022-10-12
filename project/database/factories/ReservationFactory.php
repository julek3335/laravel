<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    public function definition()
    {
        return [
            'start_date' => fake()->dateTimeBetween('-5 week', '+6 week'),
            'end_date' => fake()->dateTimeBetween('+1 week', '+7 week')
        ];
    }
}
