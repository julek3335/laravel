<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Fakecar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistrationCard>
 */
class RegistrationCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        return [
            'vehicle_identification_number' => $this->faker->vin(),
            'color' => $this->faker->safeColorName(),
            'license_plate' => $this->faker->vehicleRegistration(),
            'fuel_type' => $this->faker->vehicleFuelType(),
            'photo' => $this->faker->word(),
            'max_total_weight' => $this->faker->randomFloat(2,500,3500),
            'engine_capacity' => $this->faker->randomFloat(2,500,3000),
            'engine_power' => $this->faker->randomFloat(0,15,1500),
            'avg_fuel_consumption'=> $this->faker->randomDigitNotNull(),
            'mileage'=> $this->faker->numberBetween(1, 300000),
            'production_year' => $this->faker->year(),
            'max_axle_load' => $this->faker->randomFloat(2,500,3000),
            'max_towed_load' => $this->faker->randomFloat(2,0,8000),
            'vehicle_type_id' => $this->faker->numberBetween(1, 11),
        ];
    }
}
