<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use \App\Models\User;
use \App\Models\Company;
use \App\Models\Vehicle;
use \App\Models\Incident;
use \App\Models\Insurance;
use Illuminate\Support\Str;
use \App\Models\Reservation;
use App\Enums\UserStatusEnum;
use Illuminate\Database\Seeder;
use \App\Models\RegistrationCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $vehicle_type = $this->call(VehicleTypeSeeder::class);

        $companys = Company::factory(5)
            ->has(
                $users = User::factory(10)
                    // ->has($reservations = Reservation::factory(1))
            )
            ->has(
                $vehicles = Vehicle::factory(25)
                    ->has($registrationCards = RegistrationCard::factory())
                    ->has($incidents = Incident::factory()->count(3))
                    ->has($insurances = Insurance::factory())
                    ->has($reservations = Reservation::factory(2))
                    ->has( Service::factory())
            )
            ->create();



        //create test user Login: akowalski@mail.com Password: password
        if(env('FILESYSTEM_DISK') == 'public')
        {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker));
            $photo = $faker->image('storage'.public_path('users_photos'), 640, 480, ['face',],false);
        }else{
            $photo = fake()->randomElement(['00d1d21857410b973258af77b8ca3ea2.jpg','0a7d529a138bf95efa6ec1b6646b4a5a.jpg','0ba96848fe83a963ff8f27b999c05b8c.jpg','0c4471892f370ec4f4dec96920fe43e9.jpg','0c64ea099fca6f64f1bbb2f398bfebb1.jpg']);
        }

        DB::table('users')->insert([
            'name' => 'Adam',
            'last_name' => 'Kowalski',
            'email' => 'akowalski@mail.com',
            'auth_level' => 0,
            'company_id' => 1,
            'email_verified_at' => now(),
            'driving_licence_category' => 'B',
            'status' => UserStatusEnum::FREE,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'photo' => $photo,
        ]);

        $this->call(QualificationSeeder::class);
    }
}
