<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Enums\InsuranceStatusEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;



class InsuranceController extends Controller
{
    public function showNew($id)
    {
        return view('insurance.showNew', Insurance::findOrFail($id));
    }

    public function show($id)
    {
        return view('insurance.show',[
            'insurance' => Insurance::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('insurance.edit', [
            'insurance' => Insurance::findOrFail($id),
            'vehicles' => Vehicle::all(),
            'currentVehicle' => Vehicle::where('id', $id)->firstOrFail()
        ]);
    }

    public function showAll(){
        return view('insurance.list', [
            'insurances' => Insurance::all()->sortBy("created_at"),
        ]);
    }

    public function prepareAdd(){
        return view('insurance.add', [
            'insurance' => Insurance::all(),
            'vehicles' => Vehicle::all()
        ]);
    }

    public function create(Request $req){
        if(!Gate::allows('admins-editors')){abort(403);}
        $newInsurance = new Insurance;
        $newInsurance -> policy_number = $req -> policy_number;
        $newInsurance -> expiration_date = $req -> expiration_date;
        $newInsurance -> cost = $req -> cost;
        $newInsurance -> phone_number = $req -> phone_number;
        $newInsurance -> status = InsuranceStatusEnum::ACTIVE;
        $newInsurance -> insurer_name = $req -> insurer_name;
        $newInsurance -> description = $req -> description;
        $newInsurance -> type = $req -> selBsVehicle;
        $vehicle_id = Vehicle::where('vehicles.license_plate', $req -> license_plate)->select('vehicles.id')->firstOrFail();
        $newInsurance -> vehicle_id = $vehicle_id -> id;

        if ($req->hasFile('photo')) {

            $req->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            
            $new_file = $req->file('photo');
            $file_path = $new_file->store('insurance_photos');
 
            $newInsurance->photo = $req->photo->hashName();
        }

        $newInsurance -> save();
        $id = $newInsurance -> id;
        return view('insurance.showNew', Insurance::findOrFail($id));
     }

    
     public function updateInsurance(Request $request, $id){
        if(!Gate::allows('admins-editors')){abort(403);}

        $updateInsurance = Insurance::find($id);
        $updateInsurance-> policy_number = $request -> policy_number;
        $updateInsurance-> expiration_date = $request -> expiration_date;
        $updateInsurance-> cost = $request -> cost;
        $updateInsurance-> phone_number = $request -> phone_number;
        $updateInsurance-> insurer_name = $request -> insurer_name;
        $updateInsurance-> description = $request -> description;
        $updateInsurance-> type = $request -> selBsVehicle;
        $vehicle_id = Vehicle::where('vehicles.license_plate', $request -> selBsVehicle)->select('vehicles.id')->firstOrFail();
        $updateInsurance-> vehicle_id = $vehicle_id -> id;

        if ($request->hasFile('photo')) {
             //chyba w widoku zle jest przekazywane zdjecie nwm
            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            
            $new_file = $request->file('photo');
            $file_path = $new_file->store('insurance_photos');
 
            $updateInsurance->photo = $request->photo->hashName();
        }

        $updateInsurance->update();
        return redirect('/insurance/' . $updateInsurance->id);
    }

    public function delete(Request $request)
    {
        if( isset($request->insurance_id)){
            $insurance = Insurance::find($request->insurance_id);
            $insurance->delete();
        }
        return redirect()->route('showAllInsurances');
    }
}
