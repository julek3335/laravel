<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RegistrationCard;
use App\Models\Insurance;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /*
    ** Show single vehicle card and return view
    */
    public function show($id){
        /*
        ** Get main and additional vehicle data
        */
        $vehicle = Vehicle::findOrFail($id);
        $registrationCard = RegistrationCard::where('vehicle_id', $vehicle->id)->firstOrFail();
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->firstOrFail();

        $show_info_7_days = false;
        $show_info_end = false;
        $actual_date_plus_7 = date('Y-m-d', strtotime(date('Y-m-d').'+ 7 days'));
        $actual_date = date('Y-m-d');
        $insurances_date = $insurances->expiration_date;

        if($insurances_date <= $actual_date_plus_7 && $insurances_date > $actual_date){
            $show_info_7_days = true;
        }

        if($insurances_date <= date('Y-m-d')){
            $show_info_end = true;
        }

        /*
        ** Passing data to view
        */
        return view('vehicle', [
            'vehicle'           => $vehicle,
            'registration_card' => $registrationCard,
            'insurances'        => $insurances,
            'insurance_importance_in_7_days' => $show_info_7_days,
            'insurance_importance_end' => $show_info_end
        ]);
    }

    /*
    ** Show all vehicles and return view
    */
    public function showAll(){
        return view('vehicles', ['vehicles' => Vehicle::all()->sortBy("created_at")]);
    }

    public function showCalendar($id){
        return view('calendar', Vehicle::findOrFail($id));
    }
    
}
