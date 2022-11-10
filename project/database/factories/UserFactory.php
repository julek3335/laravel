<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Enums\UserStatusEnum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            Storage::disk('public')->makeDirectory('users_photos');
            $photo = $faker->image('storage'.public_path('users_photos'), 640, 480, ['face',],false);
        }else{
            $photo = fake()->randomElement(['00d1d21857410b973258af77b8ca3ea2.jpg','0a7d529a138bf95efa6ec1b6646b4a5a.jpg','0ba96848fe83a963ff8f27b999c05b8c.jpg','0c4471892f370ec4f4dec96920fe43e9.jpg','0c64ea099fca6f64f1bbb2f398bfebb1.jpg']);
        }

        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'driving_licence_category' => fake()->randomElement(['AM', 'A1', 'A2', 'A', 'B1', 'B','B+E','C','C1','C1+E','D','D1','D1+E','D+E','T','Tramwaj']),
            'status' => UserStatusEnum::FREE,
            'auth_level' => fake()->numberBetween(0, 2),
            'photo' => $photo,
            'remember_token' => Str::random(10),
            'notification' => '{"vehicle":[{"email": true},{"database": true}],"user":[{"email": false}, {"database": true}]}'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
