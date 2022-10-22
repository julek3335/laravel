<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use Illuminate\Database\Seeder;
use \App\Models\Vehicle;
use \App\Models\Company;
use \App\Models\User;
use \App\Models\Incident;
use \App\Models\Insurance;
use \App\Models\Reservation;
use \App\Models\RegistrationCard;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Company::factory(5)
        //     ->has(User::factory()-> count(3))
        //     ->create();

        $companys = Company::factory(5)
            ->has(
                $users = User::factory(10)
                    ->has($reservations = Reservation::factory(2))
            )
            ->has(
                $vehicles = Vehicle::factory(25)
                    ->has($registrationCards = RegistrationCard::factory())
                    ->has($incidents = Incident::factory()->count(3))
                    ->has($insurances = Insurance::factory())
                    ->has($reservations = Reservation::factory(2))
                    ->has(Service::factory())
            )
            ->create();
    }
}
