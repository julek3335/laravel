<?php

namespace Database\Factories;

use App\Enums\VehicleStatusEnum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
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
        Storage::disk('public')->makeDirectory('vehicles_photos');

        $photo1 = $faker->image('storage'.public_path('vehicles_photos'), 640, 480, ['car'],false);
        $photo2 = $faker->image('storage'.public_path('vehicles_photos'), 640, 480, ['car'],false);
        $photo3 = $faker->image('storage'.public_path('vehicles_photos'), 640, 480, ['car'],false);
        

        $photos = json_encode([$photo1,$photo2,$photo3]);

        return [
            'name' => $this->faker->userName(),
            'status' => VehicleStatusEnum::READY,
            'license_plate' => $this->faker->word(),
            'photos' => $photos,
        ];
    }
}
