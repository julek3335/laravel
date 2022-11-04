<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Insurance;
use App\Models\Vehicle;



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
        $newInsurance -> status -> name = 'ACTIVE';
        // $newInsurance -> vehicle_id = $id;
        $newInsurance -> status = $req -> status;
        $newInsurance -> save();
        $id = $newInsurance -> id;
        return view('insurance.showNew', Insurance::findOrFail($id));
     }

    
     public function updateInsurance(Request $request, $id){
        if(!Gate::allows('admins-editors')){abort(403);}

        $updateInsurance = Insurance::find($id);
        $updateInsurance->policy_number = $request->input('policy_number');
        // $updateInsurance->expiration_date = $request->input('expiration_date');
        $updateInsurance->cost = $request->input('cost');
        $updateInsurance->phone_number = $request->input('phone_number');
        $updateInsurance->vehicle_id = $request->input('vehicle_id');
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
