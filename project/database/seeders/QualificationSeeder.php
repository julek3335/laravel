<?php

namespace Database\Seeders;

use App\Models\Qualification;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qualifications')->insert([
            'name' => 'Prawo jazdy kat. B',
            'description' => ' Prawo jazdy na pojazdy do 3,5 tony.',
            'code' => 'B',
        ]);
        DB::table('qualifications')->insert([
            'name' => 'Prawo jazdy kat. C',
            'description' => 'Prawo jazdy na pojazdy powyżej 3,5 tony',
            'code' => 'C',
        ]);
        DB::table('qualifications')->insert([
            'name' => 'Prawo jazdy kat. A',
            'description' => 'Prawo jadzy na motory',
            'code' => 'A',
        ]);

        $qualificationB = Qualification::where('code', 'B')->first();
        $qualificationC = Qualification::where('code', 'C')->first();
        foreach (User::all() as $user){
            $user->qualifications()->save($qualificationB);
        }
        foreach (Vehicle::all() as $vehicle){
            $vehicle->qualifications()->save(random_int(0,100)>75?$qualificationC:$qualificationB);
        }
    }
}
