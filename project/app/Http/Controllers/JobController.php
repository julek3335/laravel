<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Vehicle;
use App\Services\VehicleRentalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JobController extends Controller
{

    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function startJob(Request $request)
    {
        $jobData = [
            'start_point' => $request->start_localization,
            'end_point' => $request->end_localization,
            'start_odometer' => $request->meter_status,
            'start_time' => new \DateTimeImmutable($request->start_time),
        ];

        $this->rentalService->rentVehicle(Auth::user()->id, $request->vehicle_id, $jobData);
    }

    public function listVehicleJobs(Request $request)
    {
        dd(Job::where('vehicle_id', 51)->get());
    }
}
