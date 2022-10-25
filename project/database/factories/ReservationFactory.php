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
        $end_date = date_add($start_date,date_interval_create_from_date_string("2 days"));
        return [
            // 'start_date' => fake()->dateTimeBetween('-5 week', '+6 week'),
            // 'end_date' => fake()->dateTimeBetween('+1 week', '+7 week')
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }
}
