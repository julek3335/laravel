<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Vehicle;
use \App\Models\Company;
use \App\Models\User;
use \App\Models\Incident;
use \App\Models\Insurance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Company::factory(5)->has(User::factory()-> count(3))->create();
        $vehicles = Vehicle::factory(25)->hasRegistrationCards()->has(Incident::factory())->has(Insurance::factory())->create();

    }
}
