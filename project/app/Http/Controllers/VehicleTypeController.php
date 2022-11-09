<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function showAll(){
        return  (['vehicleTypes' => VehicleType::all()->sortBy("created_at")]);
    }
}
