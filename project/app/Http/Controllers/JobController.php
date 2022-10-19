<?php

namespace App\Http\Controllers;

use App\Services\VehicleRentalService;
use Illuminate\Http\Request;

class JobController extends Controller
{

    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function startJob(int $userId, int $vehicleId)
    {
        $this->rentalService->rentVehicle($userId,$vehicleId);
    }
}
