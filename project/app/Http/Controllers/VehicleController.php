<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RegistrationCard;
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
        
        /*
        ** Passing data to view
        */
        return view('vehicle', [
            'vehicle'           => $vehicle,
            'registration_card' => $registrationCard
        ]);
    }

    /*
    ** Show all vehicles and return view
    */
    public function showAll(){
        return view('vehicles', ['vehicles' => Vehicle::all()->sortBy("created_at")]);
    }
    
}
