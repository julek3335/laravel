<?php

namespace App\Http\Controllers;

use App\Enums\InsuranceStatusEnum;
use App\Enums\InsuranceTypeEnum;
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

        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->load('vehicleType');

        if(isset($vehicle->photos)){
            $vehicle->photos = json_decode($vehicle->photos);
            $photos = [];
            foreach($vehicle->photos as $photo)
            {
                $photo = Storage::url('vehicles_photos/'.$photo);
                $photos[] = $photo;
            }
            $vehicle->photos = $photos;
        }else{$vehicle->photos = [];}

        $vehicleActiveInsurancesQuery = $vehicle->insurance()->where('status','=',InsuranceStatusEnum::ACTIVE);

        /*
        ** Passing data to view
        */
        return view('vehicle.show', [
            'vehicle' => $vehicle,
            'registration_card' => $vehicle->registrationCards()->first(),
            'insurances' => $vehicle->insurance()->get(),
            'incidents_resolved' => $vehicle->incidents()->where('status', '=' , 'resolved')->get(),
            'incidents_others' => $vehicle->incidents()->where('status', '<>' , 'resolved')->get(),
            'carInsurances' =>$vehicle->insurance()->get(),
            'entitlements' => Auth::user()->auth_level,
            'reservations' => $vehicle->reservations()->with('user')->get(),
            'activeInsurance' => $vehicleActiveInsurancesQuery->get(),
            'jobs' => $vehicle->jobs()->get(),
            'activeInsuraneOC' => $vehicleActiveInsurancesQuery
                ->whereIn('type', [InsuranceTypeEnum::OC, InsuranceTypeEnum::OC_AC])->get(),
            'insuranceEnds' => $vehicleActiveInsurancesQuery
                ->whereBetween('expiration_date', [date('Y-m-d'), date('Y-m-d',strtotime("+7 day"))])->get(),
            'assignedUser' => $vehicle->user()->first(),
            'incidents_count' => $vehicle->incidents()->count(),
            'jobs_count' => $vehicle->jobs()->count(),
            'avaibleUsers' => User::all(),
            'serviceEvents' => $vehicle->serviceEvents()->get()
        ]);
    }

    /*
    ** Prepare vehicle data for add
    */
    public function prepareAdd(){

        $vehicleTypes = VehicleType::all();

        return view('vehicle.add', [
            'vehicle_types' => $vehicleTypes,
            'users' => User::all(),
            'entitlements' => Auth::user()-> auth_level,
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
        ->leftJoin('users', 'users.id', '=', 'vehicles.user_id')
        ->firstOrFail();

        if(isset($vehicle->photos)){
            $vehicle->photos = json_decode($vehicle->photos);
            $photos = [];
            foreach($vehicle->photos as $photo)
            {
                $photo = Storage::url('vehicles_photos/'.$photo);
                $photos[] = $photo;
            }
            $vehicle->photos = $photos;
        }else{$vehicle->photos = [];}
        $registrationCard = RegistrationCard::where('vehicle_id', $vehicle->id)->firstOrFail();
        $insurances = Insurance::where('vehicle_id', $vehicle->id)->first();
        $vehicleTypes = VehicleType::all();

        $assignedUserID = $vehicle->user_id;
        $assignedUser = User::findOrFail($assignedUserID);

        /*
        ** Passing data to view
        */
        return view('vehicle.edit', [
            'vehicle' => $vehicle,
            'registration_card' => $registrationCard,
            'vehicle_types' => $vehicleTypes,
            'assignedUser' => $assignedUser,
            'users' => User::all(),
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
        ->leftJoin('users', 'users.id', '=', 'vehicles.user_id')
        ->firstOrFail();

        $vehicle->name = $req->name;
        $vehicle->status = 'ready';
        $vehicle->license_plate = $req->license_plate;
        // $vehicle->company_id = $req->company_id;
        $vehicle->vehicle_type_id = $vehicle_type_id;
        $vehicle->user_id = $req->user_id;

        if ($req->hasFile('photos')) {
            $req->validate([
                'photos.*' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            if($vehicle->photos)
                $image_arr = json_decode($vehicle->photos);
            else
                $image_arr = [];

            foreach($req->file('photos') as $image)
            {
                $file_path = $image->store('vehicles_photos');

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
        $registrationCard->brand = $req->brand;
        $registrationCard->model = $req->model;
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
    public function showAll()//
    {
        $vehicles = Vehicle::select('vehicles.id as id','vehicles.*','vehicle_types.id as vehicle_type_id','vehicle_types.type','users.email as user_email')
        ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
        ->leftJoin('users', 'users.id', '=', 'vehicles.user_id')
        ->get();
        return view('vehicle.list', [
            'vehicles' => $vehicles,
            'entitlements' => Auth::user()-> auth_level,
        ]);
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
        $vehicle->user_id = $req->user_id;
        $vehicle->odometer  = $req->odometer;
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
        $registrationCard->brand = $req->brand;
        $registrationCard->model = $req->model;
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
            $vehicle = Vehicle::find($request->vehicle_id);
            try {
                $vehicle->delete();
                $code = 200;
                $message = 'Pojazd został usunięty';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        }
        return redirect()->route('vehicle-show-all')
        ->with('return_code', $code)
        ->with('return_message', $message);
    }
}
