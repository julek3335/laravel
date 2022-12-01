<?php

namespace App\Services;

use App\Enums\JobStatusEnum;
use App\Enums\UserStatusEnum;
use App\Enums\VehicleStatusEnum;
use App\Http\Requests\EndJobRequest;
use App\Models\Job;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;

class VehicleRentalService
{
    public function rentVehicle(int $vehicleId, int $userId, array $jobData): ?Job
    {
        $vehicle = $this->vehicleIsFree($vehicleId, $userId);
        if (is_null($vehicle)) {
            return null;
        }


        $user = $this->userIsReady($userId);
        if (is_null($user)) {
            return null;
        }

        if (! $this->verifyQualification($user, $vehicle)) {
            return null;
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
        $job->vehicle()->update(['status' => VehicleStatusEnum::IN_USE]);
        $job->user()->update(['status' => UserStatusEnum::RENTING]);
        return $job;
    }

    protected function vehicleIsFree(int $vehicleId, $userId): ?Vehicle
    {
        $car = Vehicle::find($vehicleId);
        if ($car->status == VehicleStatusEnum::READY) {
            return $car;
        }
        if ($car->status == VehicleStatusEnum::RESERVED) {
            $reservation = Reservation::where('vehicle_id', $vehicleId)
                ->where('user_id', $userId)
                ->whereDate('start_date', '>=', now())
                ->whereDate('end_date', '<=', now())->first();
            if ($reservation != null) {
                return $car;
            }
        }
        return null;
    }

    protected function userIsReady(int $id): ?User
    {
        $user = User::find($id);
        if ($user->status == UserStatusEnum::FREE) {
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

    public function finishJob(EndJobRequest $request): Job
    {
        /** @var Job $job */
        $job = Job::find($request->job_id);
        $job->status = JobStatusEnum::FINISHED;
        $job->end_time = new \DateTimeImmutable($request->end_time);
        $job->end_odometer = $request->end_odometer;
        $job->end_point = $request->end_localization;
        $job->description = $request->description;
        $job->distance = $this->calculateTravelDistance($job->start_odometer, $job->end_odometer);
        $job->vehicle()->update(['status' => VehicleStatusEnum::READY, 'odometer' => $request->end_odometer]);
        $job->user()->update(['status' => UserStatusEnum::FREE]);

        //not saved changes in job
        return $job;
    }
}
