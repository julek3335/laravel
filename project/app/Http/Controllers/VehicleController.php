<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Incident;
use App\Models\Insurance;
use App\Models\Reservation;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\RegistrationCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $vehicle = Vehicle::where('vehicles.id', $id)
        ->select('vehicles.id as id','vehicles.*','vehicle_types.id as vehicle_type_id','vehicle_types.type','users.email as user_email')
        ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
        ->join('users', 'users.id', '=', 'vehicles.user_id')
        ->firstOrFail();

        if(isset($vehicle->photos)){
            $vehicle->photos = json_decode($vehicle->photos);
        }else{$vehicle->photos = [];}
       
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

        $insuranceActive = Insurance::where([
            ['vehicle_id', '=', $vehicle->id],
            ['status', '=', 'active']
        ])->get()->sortBy('created_at');

        //jobs list
        $jobs = Job::where('jobs.vehicle_id' , $id)->get();

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
            'entitlements' => Auth::user()->auth_level, 
            'reservations' => Reservation::where('vehicle_id' , '=', $id)->get(),
            'activeInsurance' => $insuranceActive,
            'jobs' => $jobs,
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
        $vehicle = Vehicle::where('vehicles.id', $id)
        ->select('vehicles.id as id','vehicles.*','vehicle_types.id as vehicle_type_id','vehicle_types.type','users.email as user_email')
        ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
        ->join('users', 'users.id', '=', 'vehicles.user_id')
        ->firstOrFail();

        $vehicle->photos = json_decode($vehicle->photos);
        $registrationCard = RegistrationCard::where('vehicle_id', $vehicle->id)->firstOrFail();
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->first();
        $vehicleTypes = VehicleType::all();
        /*
        ** Passing data to view
        */
        return view('vehicle.edit', [
            'vehicle' => $vehicle,
            'registration_card' => $registrationCard,
            'vehicle_type' => $vehicleTypes
        ]);
    }

    /*
    ** Edit vehivle from form
    */
    public function updateVehicle(Request $req, $id)
    {
        //Add new vehicle
        $vehicle_type_id = current((array) DB::table('vehicle_types')->select('vehicle_types.id as vehicle_types_id')->where('vehicle_types.type', '=', $req->selBsVehicle)->first());
        
        $vehicle = Vehicle::where('vehicles.id', $id)
        ->select('vehicles.id as id','vehicles.*','vehicle_types.id as vehicle_type_id','vehicle_types.type','users.email as user_email')
        ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
        ->join('users', 'users.id', '=', 'vehicles.user_id')
        ->firstOrFail();

        $vehicle->name = $req->name;
        $vehicle->status = 'ready';
        $vehicle->license_plate = $req->license_plate;
        // $vehicle->company_id = $req->company_id;
        $vehicle->vehicle_type_id = $vehicle_type_id;
        // $vehicle->user_id = $req->user_id;

        if ($req->hasFile('photos')) {
            $req->validate([
                'photos.*' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $image_arr = json_decode($vehicle->photos);

            foreach($req->file('photos') as $image)
            {
                $file_path = $image->store('vehicles_photos', 'public'); 
                
                $image_name_hash = $image->hashName();
                array_push($image_arr, $image_name_hash);
            }

            $vehicle->photos = json_encode($image_arr);
        }
        try {
            $vehicle->save();
            $code = 200;
            $message = 'Pojazd został zaktalizowany';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
        }

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
        
        try {
            $registrationCard->save();
            $code = 200;
            $message = 'Karta została zaktalizowana.';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
        }

        return redirect('/vehicle/edit/' . $vehicle->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

    /*
    **  Delete vehicle photo
    */
    public function deleteVehiclePhoto($id, $photo_name){

        $vehicle = Vehicle::where('vehicles.id', $id)->firstOrFail();

        $vehicle_photos = json_decode($vehicle->photos);

        $key = array_search($photo_name, $vehicle_photos);
        if ($key !== false) {
            unset($vehicle_photos[$key]);
        }
        
        $vehicle->photos = json_encode(array_values($vehicle_photos));
        $vehicle->save();

        Storage::disk('public')->delete('vehicles_photos/'.$photo_name);

        return redirect('/vehicle/edit/' . $vehicle->id)        
        ->with('return_code', '200')
        ->with('return_message', 'Zdjęcie zostało usunięte');
    }

    /*
    ** Show all vehicles and return view
    */
    public function showAll()
    {
        $vehicles = DB::table('vehicles')
        ->select('vehicles.id as id','vehicles.*','vehicle_types.id as vehicle_type_id','vehicle_types.type','users.email as user_email')
        ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
        ->join('users', 'users.id', '=', 'vehicles.user_id')
        ->get();

        return view('vehicle.list', ['vehicles' => $vehicles]);
    }

    /*
    ** Add new vehicle
    */
    public function store(Request $req)
    {
        $vehicle_type_id = current((array) DB::table('vehicle_types')->select('vehicle_types.id as vehicle_types_id')->where('vehicle_types.type', '=', $req->selBsVehicle)->first());
        //Add new vehicle
        $vehicle = new Vehicle;
        $vehicle->name = $req->name;
        $vehicle->status = 'ready';
        $vehicle->license_plate = $req->license_plate;
        // $vehicle->company_id = $req->company_id;
        $vehicle->vehicle_type_id = $vehicle_type_id;
        // $vehicle->user_id = $req->vehicle_user_id;
        if ($req->hasFile('photos')) {
            $req->validate([
                'photos.*' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $image_arr = [];

            foreach($req->file('photos') as $image)
            {
                $file_path = $image->store('vehicles_photos', 'public'); 
                
                $image_name_hash = $image->hashName();
                array_push($image_arr, $image_name_hash);
            }

            $vehicle->photos = json_encode($image_arr);
        }

        try {
            $vehicle->save();
            $code = 200;
            $message = 'Pojazd został zaktalizowany';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
        }

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

        return redirect('/vehicles/' . $vehicle->id)        
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

    public function showCalendar($id)
    {
        return view('calendar', Vehicle::findOrFail($id));
    }

    public function delete(Request $request)
    {
        if (isset($request->vehicle_id)) {
            $user = Vehicle::find($request->vehicle_id)->first();
            try {
                $user->delete();
                $code = 200;
                $message = 'Pojazd został usunięty';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        }
        return redirect()->route('showAllVehicles')        
        ->with('return_code', $code)
        ->with('return_message', $message);
    }
}
