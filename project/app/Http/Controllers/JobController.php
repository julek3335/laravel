<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\VehicleRentalService;

class JobController extends Controller
{

    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function startJob(Request $req)
    {
        $this->rentalService->rentVehicle(Auth::user()->id, $req->vehicle_id);
    }

    public function showAll()
    {
        return view('jobs.list',  ['jobs' => Job::all()->sortBy("created_at")]);
    }
}
