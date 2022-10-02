<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Vehicle;

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
        \App\Models\Company::factory(5)->has(\App\Models\User::factory()-> count(3))->create();
        $vehicles = Vehicle::factory(25)->hasRegistrationCards()->create();

    }
}
