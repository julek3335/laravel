<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Incident;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            //Trzeba zmienić żeby zwracało tylko wolne pojazdy a nie wszystkie
            'availableVehicles' => Vehicle::all(), 
            'numberOfVehicles'  => Vehicle::all()->count(),
            'numberOfUsers'     => User::all()->count(), 
            
            //Trzeba zmienić żeby zwracało tylko wolnych pracowników a nie wszystkich
            'avaibleUsers'      => User::all(), 
            'numberOfIncidents' => Incident::all()->count(),
            'numberOfServices' => Service::all()->count(),
            'entitlements'       => Auth::user()-> auth_level
        ]);
    }
}
