<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Vehicle;
use App\Services\VehicleRentalService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'start_point' => $request->start_localization??'',
            'end_point' => $request->end_localization??'',
            'start_odometer' => $request->meter_status??'',
            'start_time' => new \DateTimeImmutable($request->start_time??now()),
        ];

        $this->rentalService->rentVehicle($request->vehicle_id, Auth::user()->id , $jobData);

    }

    public function listVehicleJobs(Request $request)
    {
        return Job::where('vehicle_id', $request->vehicle_id)->get();
    }

    public function showAll()
    {
        return view('jobs.list',  ['jobs' => Job::all()->sortBy("created_at")]);
    }
}
