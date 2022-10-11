<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsuranceController extends Controller
{
    public function show($id)
    {
        return view('insurance.show', Insurance::findOrFail($id));
    }

    public function showAll(){
        return view('insurance', ['insurances' => Insurance::all()->sortBy("created_at")]);
    }

    public function created(Request $req){
        $newInsurance = new Insurance;
        $newInsurance -> policy_number = $req -> policy_number;
        $newInsurance -> expiration_date = $req -> expiration_date;
        $newInsurance -> cost = $req -> cost;
        $newInsurance -> phone_number = $req -> phone_number;
        $newInsurance -> vehicle_id = $req -> vehicle_id;
        $newInsurance -> save();
        $id = $newInsurance -> id;
        return view('Insurance', Insurance::findOrFail($id));
     }

     public function update(Request $request, $id){
        $updateInsurance = Insurance::find($id);
        $updateInsurance->policy_number = $request->input('policy_number');
        $updateInsurance->expiration_date = $request->input('expiration_date');
        $updateInsurance->cost = $request->input('cost');
        $updateInsurance->phone_number = $request->input('phone_number');
        $updateInsurance->vehicle_id = $request->input('vehicle_id');
        $updateInsurance->update();
        return view('Insurance', Insurance::findOrFail($id));
    }
}