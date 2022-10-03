<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function show($id){
        return view('vehicle', Vehicle::findOrFail($id));
    }

    public function showAll(){
        return view('vehicles', ['vehicles' => Vehicle::all()->sortBy("created_at")]);
    }
    
}
