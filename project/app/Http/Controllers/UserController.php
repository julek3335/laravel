<?php

namespace App\Http\Controllers;
use App\Services\VehicleRentalService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function show($id){

        return view('user',[
            'user' => User::findOrFail($id),
            'reservations' => Reservation::where('user_id' , '=', $id)->get(),
            'entitlements' => Auth::user()-> auth_level,
            'avaibleUsers' => User::all(),
        ]);
    }

    public function userToEdit($id){
        return view('edit-user', User::findOrFail($id));
    }

    public function updateUser(Request $request, $id){
        $updateUser = User::find($id);
        $updateUser->name = $request->input('name');
        $updateUser->last_name = $request->input('last_name');
        $updateUser->status = $request->input('status');
        $updateUser->email = $request->input('email');
        $updateUser->driving_licence_category = $request->input('driving_licence_category');
        $updateUser -> auth_level = $request -> input('auth_level');
        $updateUser->update();
        return view('user',[
            'user' => User::findOrFail($id),
            'reservations' => Reservation::where('user_id' , '=', $id)->get()
        ]);
    }

    public function showAll(){
        return view('users', ['users' => User::all()->sortBy("created_at")]);
    }

    public function created(Request $req){
       $newUser = new User;
       $newUser -> name = $req -> name;
       $newUser -> last_name = $req -> last_name;
       $newUser -> email = $req -> email;
       $newUser -> driving_licence_category = $req -> driving_licence_category;
       $newUser -> password = $req -> password;
       $newUser -> auth_level = $req -> auth_level;
       $newUser -> save();
       $id = $newUser -> id;
       return view('user', User::findOrFail($id));
    }


    public function isQualified(Request $request)
    {
        return $this->rentalService->verifyQualification(Auth::user(),Vehicle::find($request->vehicle_id));
    }
    
    public function delete(Request $request)
    {
        if( isset($request->user_id)){
            $user = User::find($request->user_id)->first();
            $user->delete();
        }
        return redirect()->route('showAllUsers');
    }
}
