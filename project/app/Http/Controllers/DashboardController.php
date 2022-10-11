<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'availableVehicles' => Vehicle::all()->where('status', 1), 
            'numberOfVehicles' => Vehicle::all()->count()
        ]);
    }
}
