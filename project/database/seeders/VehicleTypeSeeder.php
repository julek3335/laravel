<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_types')->insert([
            'type' => 'Osobowy',
            'icon' => 'fa fa-fw fa-car',
        ]);
        DB::table('vehicle_types')->insert([
            'type' => 'Dostawczy',
            'icon' => 'fa fa-fw fa-truck',
        ]);
        DB::table('vehicle_types')->insert([
            'type' => 'Ciężarowy',
            'icon' => 'fa fa-fw fa-truck-moving',
        ]);
        DB::table('vehicle_types')->insert([
            'type' => 'Motocykl',
            'icon' => 'fa fa-fw fa-motorcycle',
        ]);
    }
}
