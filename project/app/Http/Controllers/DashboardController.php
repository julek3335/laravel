<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Incident;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'availableVehicles' => Vehicle::all()->where('status', 'READY'), 
            'numberOfVehicles'  => Vehicle::all()->count(),
            'numberOfUsers'     => User::all()->count(), 
            'numberOfIncidents' => Incident::all()->count()
        ]);
    }
}
