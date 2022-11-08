<?php

namespace App\Services;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceHandlingService
{
    public function createService(Request $request)
    {
        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->next_time = $request->next_time;
        $service->interval = $request->interval;
        $service->save();
        $service->vehicles()->saveMany($this->getVehicles($request->vehicles));

        return $service;
    }

    public function updateService(Request $request, int $id)
    {
        $service = Service::find($id);
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->next_time = $request->input('next_time');
        $service->interval = $request->input('interval');
        $service->vehicles()->sync($request->vehicles);
        $service->update();
        return $service;
    }

    protected function getVehicles(array $ids)
    {
        return Vehicle::whereIn('id', $ids)->get();
    }

}
