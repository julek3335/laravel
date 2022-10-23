<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\RegistrationCard;
use App\Models\Insurance;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /*
    ** Show single vehicle card and return view
    */
    public function show($id)
    {
        /*
        ** Get main and additional vehicle data
        */
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->photos = json_decode($vehicle->photos);
        $registrationCard = RegistrationCard::where('vehicle_id', $vehicle->id)->firstOrFail();
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->first();
        $incidents_resolved = Incident::where([
            ['vehicle_id', '=', $vehicle->id],
            ['status', '=', 'resolved']
        ])->get()->sortBy('created_at');
        $incidents_others = Incident::where([
            ['vehicle_id', '=', $vehicle->id],
            ['status', '<>', 'resolved']
        ])->get()->sortBy('created_at');

        //here must be insurance with the longest expiration date
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->first();

        $show_info_7_days = false;
        $show_info_end = false;
        if ($insurances) {
            $actual_date_plus_7 = date('Y-m-d', strtotime(date('Y-m-d') . '+ 7 days'));
            $actual_date = date('Y-m-d');
            $insurances_date = $insurances->expiration_date;

            if ($insurances_date <= $actual_date_plus_7 && $insurances_date > $actual_date) {
                $show_info_7_days = true;
            }

            if ($insurances_date <= date('Y-m-d')) {
                $show_info_end = true;
            }
        }

        /*
        ** Passing data to view
        */
        return view('vehicle.show', [
            'vehicle' => $vehicle,
            'registration_card' => $registrationCard,
            'insurances' => $insurances,
            'incidents_resolved' => $incidents_resolved,
            'incidents_others' => $incidents_others,
            'insurance_importance_in_7_days' => $show_info_7_days,
            'insurance_importance_end' => $show_info_end,
            'carInsurances' => Insurance::where('vehicle_id', '=', $id)->get(),
            'entitlements' => Auth::user()->auth_level
        ]);
    }

    /*
    ** Get vehicle data to edit action
    */
    public function edit($id)
    {
        /*
        ** Get main and additional vehicle data
        */
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->photos = json_decode($vehicle->photos);
        $registrationCard = RegistrationCard::where('vehicle_id', $vehicle->id)->firstOrFail();
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->first();

        /*
        ** Passing data to view
        */
        return view('vehicle.edit', [
            'vehicle' => $vehicle,
            'registration_card' => $registrationCard
        ]);
    }

    /*
    ** Edit vehivle from form
    */
    public function updateVehicle(Request $req, $id)
    {
        //Add new vehicle
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->name = $req->name;
        $vehicle->status = 'ready';
        $vehicle->license_plate = $req->license_plate;
        $vehicle->company_id = 1;
        $vehicle->save();

        //Add registration card
        $registrationCard = RegistrationCard::where('vehicle_id', $id)->firstOrFail();
        $registrationCard->vehicle_identification_number = $req->vehicle_identification_number;
        $registrationCard->max_total_weight = $req->max_total_weight;
        $registrationCard->engine_capacity = $req->engine_capacity;
        $registrationCard->engine_power = $req->engine_power;
        $registrationCard->production_year = $req->production_year;
        $registrationCard->max_axle_load = $req->max_axle_load;
        $registrationCard->max_towed_load = $req->max_towed_load;
        $registrationCard->axle = $req->axle;
        $registrationCard->siting_places = $req->siting_places;
        $registrationCard->standing_places = $req->standing_places;
        $registrationCard->vehicle_id = $vehicle->id;
        $registrationCard->save();

        /*
        ** Passing data to view
        */
        return view('vehicle.edit', [
            'vehicle' => $vehicle,
            'registration_card' => $registrationCard
        ]);
    }

    /*
    ** Show all vehicles and return view
    */
    public function showAll()
    {
        return view('vehicle.list', ['vehicles' => Vehicle::all()->sortBy("created_at")]);
    }

    /*
    ** Add new vehicle
    */
    public function store(Request $req)
    {
        //Add new vehicle
        $vehicle = new Vehicle;
        $vehicle->name = $req->name;
        $vehicle->status = 'ready';
        $vehicle->license_plate = $req->license_plate;
        $vehicle->company_id = 1;
        $vehicle->save();

        //Add registration card
        $registrationCard = new RegistrationCard;
        $registrationCard->vehicle_identification_number = $req->vehicle_identification_number;
        $registrationCard->max_total_weight = $req->max_total_weight;
        $registrationCard->engine_capacity = $req->engine_capacity;
        $registrationCard->engine_power = $req->engine_power;
        $registrationCard->production_year = $req->production_year;
        $registrationCard->max_axle_load = $req->max_axle_load;
        $registrationCard->max_towed_load = $req->max_towed_load;
        $registrationCard->axle = $req->axle;
        $registrationCard->siting_places = $req->siting_places;
        $registrationCard->standing_places = $req->standing_places;
        $registrationCard->vehicle_id = $vehicle->id;
        $registrationCard->save();

        return redirect('/vehicles/' . $vehicle->id);
    }

    public function showCalendar($id)
    {
        return view('calendar', Vehicle::findOrFail($id));
    }

    public function delete(Request $request)
    {
        if (isset($request->vehicle_id)) {
            $user = Vehicle::find($request->vehicle_id)->first();
            $user->delete();
        }
        return redirect()->route('showAllVehicles');
    }
}
