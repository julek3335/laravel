<?php

namespace App\Http\Controllers;

use App\Enums\UserStatusEnum;
use App\Enums\VehicleStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Incident;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $userId = Auth::user()->id;

        $vehicles = Vehicle::where('status', '=', VehicleStatusEnum::READY)->get();
        $users = User::where('status', '=', UserStatusEnum::FREE)->get();

        $jobs = Job::where('jobs.user_id', Auth::user()->id)->where('jobs.status', 'in_progress')->get();
        $jobs->load('vehicle');
        return view('dashboard', [
            'availableVehicles' => $vehicles,
            'numberOfVehicles' => $vehicles->count(),//można policzyć na froncie
            'numberOfUsers' => $users->count(),//można policzyć na froncie
            'avaibleUsers' => $users,
            'numberOfIncidents' => Incident::all()->count(),
            'numberOfServices' => Service::all()->count(),
            'entitlements' => Auth::user()->auth_level,
            'userVehicles' => Vehicle::where('user_id', '=', $userId),

            // trasy dla aktualnie zalogowanego użytkownika
            'userJobs' => $jobs,
        ]);
    }
}
