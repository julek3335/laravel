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
            'start_odometer' => $request->start_odometer??null,
            'start_time' => new \DateTimeImmutable($request->start_time??now()),
        ];

        $job = $this->rentalService->rentVehicle($request->vehicle_id, Auth::user()->id , $jobData);

        return redirect('/jobs/' . $job->id);
    }

    public function listVehicleJobs(Request $request)
    {
        return Job::where('vehicle_id', $request->vehicle_id)->get();
    }

    public function show($id)
    {
        return view('job.show',  ['job' => Job::findOrFail($id)]);
    }

    public function showAll()
    {
        return view('job.list',  ['jobs' => Job::all()->sortBy("created_at")]);
    }
}
