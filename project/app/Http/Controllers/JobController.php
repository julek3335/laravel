<?php

namespace App\Http\Controllers;

use App\Enums\JobStatusEnum;
use App\Http\Requests\EndJobRequest;
use App\Http\Requests\StartJobRequest;
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

    public function startJob(StartJobRequest $request)
    {
        $jobData = [
            'start_point' => $request->start_localization,
            'end_point' => $request->end_localization,
            'start_odometer' => $request->start_odometer,
            'start_time' => new \DateTimeImmutable($request->start_time),
        ];

        $job = $this->rentalService->rentVehicle($request->vehicle_id, Auth::user()->id, $jobData);

        return redirect('/jobs/' . $job->id);
    }

    public function endJob(EndJobRequest $request)
    {
        /** @var Job $job */
        $job = Job::find($request->job_id);
        $job->status = JobStatusEnum::FINISHED;
        $job->end_time = new \DateTimeImmutable($request->end_time);
        $job->end_odometer = $request->end_odometer;
        $job->description = $request->description;
        $job->distance = $this->rentalService->calculateTravelDistance($job->start_odometer, $job->end_odometer);
        $job->save();
    }

    public function listVehicleJobs(Request $request)
    {
        return Job::where('vehicle_id', $request->vehicle_id)->get();
    }

    public function show($id)
    {
        /** @var Job $job */
        $job = Job::findOrFail($id);
        $job->load(['user', 'vehicle']);
        return view('job.show', ['job' => $job]);
    }

    public function showAll()
    {
        $jobs = Job::all()->sortBy("created_at");
        $jobs->load(['user', 'vehicle']);
        return view('job.list', ['jobs' => $jobs]);
    }
}
