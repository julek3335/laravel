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
        $start_date = fake()->dateTimeBetween('-15 week', '+15 week');
        return [
            'start_date' => $start_date,
            'end_date' => fake()->dateTimeInInterval($start_date),
            'user_id' => fake()->numberBetween(1, 51),
        ];
    }
}
