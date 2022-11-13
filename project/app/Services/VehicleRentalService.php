<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\UserStatusEnum;
use App\Enums\VehicleStatusEnum;
use App\Models\Job;
use App\Models\Qualification;
use App\Models\User;
use App\Models\Vehicle;

class VehicleRentalService
{
    public function rentVehicle(int $vehicleId, int $userId, array $jobData)
    {
        $vehicle = $this->vehicleIsFree($vehicleId);
        if (is_null($vehicle)) {
            return;
        }


        $user = $this->userIsReady($userId);
        if (is_null($user)) {
            return;
        }

        if (! $this->verifyQualification($user, $vehicle)) {
            return;
        }

        $job = Job::create(
            array_merge(
                [
                    'vehicle_id' => $vehicle->id,
                    'user_id' => $user->id,
                    'status' => JobStatusEnum::IN_PROGRESS,
                ],
                $jobData
            )
        );

        return $job;
    }

    protected function vehicleIsFree(int $id): ?Vehicle
    {
        $car = Vehicle::find($id);
        if($car->status == VehicleStatusEnum::READY){
            return $car;
        }
        return null;
    }

    protected function userIsReady(int $id): ?User
    {
        $user = User::find($id);
        if($user->status == UserStatusEnum::FREE){
            return $user;
        }
        return null;
    }

    public function verifyQualification(User $user, Vehicle $vehicle): bool
    {
        $vehicleRequirements = $vehicle->qualifications()->allRelatedIds()->all();
        $userQualifications = $user->qualifications()->allRelatedIds()->all();

        foreach ($vehicleRequirements as $requirement) {
            if (! in_array($requirement, $userQualifications)) {
                return false;
            }
        }
        return true;
    }


    public function calculateTravelDistance(float $startOdo, float $endOdo): float
    {
        return $endOdo - $startOdo;
    }
}
