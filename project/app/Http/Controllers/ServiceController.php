<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Service;
use App\Models\Vehicle;
use App\Services\ServiceHandlingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{

    protected ServiceHandlingService $serviceHandlingService;

    public function __construct(ServiceHandlingService $serviceHandlingService)
    {
        $this->serviceHandlingService = $serviceHandlingService;
    }

    public function show($id)
    {
        return view('service.show', [
            'service' => Service::findOrFail($id),
            'services_vehicles' => DB::table('service_vehicle')
                ->join('vehicles', 'service_vehicle.vehicle_id', '=', 'vehicles.id')
                ->where('service_id', $id)->get()
        ]);
    }

    public function showAll()
    {
        return view('service.list', ['services' => Service::all()->sortBy("created_at")]);
    }

    public function prepareAdd()
    {
        return view('service.add', [
            'service' => [],
            'availableVehicles' => Vehicle::all(),
        ]);
    }

    public function prepareEdit($id)
    {
        return view('service.edit', [
            'service' => Service::findOrFail($id),
            'selectedVehicles' => DB::table('service_vehicle')->where('service_id', $id)->get(),
            'availableVehicles' => Vehicle::all(),
        ]);
    }

    public function store(Request $request)
    {
        if (! Gate::allows('admins-editors')) {
            abort(403);
        }

        $service = $this->serviceHandlingService->createService($request);

        return redirect('/service/' . $service->id);
        //return print_r($request->vehicles);
    }

    public function update(Request $request, $id)
    {
        $service = $this->serviceHandlingService->updateService($request, $id);

        return redirect('/service/' . $service->id);
    }

    public function delete(Request $request)
    {
        if (isset($request->service_id)) {
            $service = Service::find($request->service_id);
            $service->delete();
        }
        return redirect()->route('service-show-all');
    }

}
