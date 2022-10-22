<?php

namespace App\Http\Controllers;

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

    public function startJob(Request $req)
    {
        $this->rentalService->rentVehicle(Auth::user()->id, $req->vehicle_id);
    }
}
