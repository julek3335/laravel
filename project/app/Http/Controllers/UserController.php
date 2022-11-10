<?php

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Services\VehicleRentalService;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function showCurrentProfile(){

        $id = Auth::user()-> id;
        $user = User::findOrFail($id);
        $user -> photo = Storage::url('users_photos/'.$user -> photo);

        return view('user.show',[
            'user' => $user,
            'reservations' => Reservation::where('user_id' , '=', $id)->get(),
            'entitlements' => Auth::user()-> auth_level,
            'avaibleUsers' => User::all(),
            'userJobs'     => Job::where('jobs.user_id' , $id)
                                ->join('vehicles', 'vehicles.id', '=', 'jobs.vehicle_id')
                                ->select('jobs.*', 'vehicles.id as vehicle_id', 'vehicles.name')
                                ->get(),
        ]);
    }

    public function show($id){
        $user = User::findOrFail($id);
        // if($user-> auth_level == 0)
        // {
        //     $message = 'U are admin!';
        //     $user -> notify(new TestNotification($message));
        // }

        $user = User::findOrFail($id);
        $user -> photo = Storage::url('users_photos/'.$user -> photo);

        return view('user.show',[
            'user' => $user,
            'reservations' => Reservation::where('user_id' , '=', $id)->get(),
            'entitlements' => Auth::user()-> auth_level,
            'avaibleUsers' => User::all(),
            'userJobs'     => Job::where('jobs.user_id' , $id)
                                ->join('vehicles', 'vehicles.id', '=', 'jobs.vehicle_id')
                                ->select('jobs.*', 'vehicles.id as vehicle_id', 'vehicles.name')
                                ->get(),
        ]);
    }

    public function userToEdit($id){
        return view('user.edit', ['user' => User::findOrFail($id)]);
    }

    public function prepareAdd(){
        return view('user.add', []);
    }

    public function updateUser(Request $request, $id){

        $updateUser = User::find($id);
        $updateUser->name = $request->input('name');
        $updateUser->last_name = $request->input('last_name');
        $updateUser->status = $request->input('status');
        $updateUser->email = $request->input('email');
        $updateUser->driving_licence_category = $request->input('driving_licence_category');
        $updateUser -> auth_level = $request -> input('auth_level');

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            
            $new_file = $request->file('photo');
            $file_path = $new_file->store('users_photos');
 
            $updateUser->photo = $request->photo->hashName();
        }

        $updateUser->update();

        return redirect('/user/' . $updateUser->id);
    }

    public function showAll(){
        return view('user.list', ['users' => User::all()->sortBy("created_at")]);
    }

    public function store(Request $request){

        $newUser = new User;

        $photo_value = null;
        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            
            $new_file = $request->file('photo');
            $file_path = $new_file->store('users_photos');
 
            $photo_value = $request->photo->hashName();
        }
       
        $newUser->name = $request -> name;
        $newUser->last_name = $request -> last_name;
        $newUser->email = $request -> email;
        $newUser->driving_licence_category = $request -> driving_licence_category;
        $newUser->photo = $photo_value;
        $newUser->status = $request->status;
        $newUser->password = Hash::make($request->password);
        $newUser->auth_level = $request -> auth_level;
        $newUser->save();

        return redirect('/user/' . $newUser->id);
    }


    public function isQualified(Request $request)
    {
        return $this->rentalService->verifyQualification(Auth::user(),Vehicle::find($request->vehicle_id));
    }
    
    public function delete(Request $request)
    {
        if( isset($request->user_id)){
            $user = User::find($request->user_id);
            $user->delete();
        }
        return redirect()->route('showAllUsers');
    }
}
