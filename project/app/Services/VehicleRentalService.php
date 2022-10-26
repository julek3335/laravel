<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Models\Job;
use App\Models\Qualification;
use App\Models\User;
use App\Models\Vehicle;

class VehicleRentalService
{
    public function rentVehicle(int $vehicleId,int $userId)
    {
        $vehicle = $this->vehicleIsFree($vehicleId);
        if (is_null($vehicle)) {
            return;
        }


        $user = $this->userIsReady($userId);
        if (is_null($user)) {
            return;
        }

        if(!$this->verifyQualification($user, $vehicle)){
            return;
        }

        $job = Job::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => $user->id,
            'status' => JobStatusEnum::IN_PROGRESS,
        ]);

        return $job;
    }

    protected function vehicleIsFree(int $id): ?Vehicle
    {
        return Vehicle::find($id);
    }

    protected function userIsReady(int $id): ?User
    {
        return User::find($id);
    }

    public function verifyQualification(User $user,Vehicle $vehicle): bool
    {

        $vehicleRequirements = $vehicle->qualifications()->allRelatedIds()->all();
        $userQualifications = $user->qualifications()->allRelatedIds()->all();

        foreach ($vehicleRequirements as $requirement){
             if(!in_array($requirement,$userQualifications)){
                 return false;
             }
        }
        return true;
    }

}
