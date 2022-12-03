<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserStoreRequest;
use App\Models\Job;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Services\VehicleRentalService;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function showCurrentProfile(){

        $id = Auth::user()-> id;

        return redirect('/user/' . $id);
    }

    public function show($id){
        $user = User::findOrFail($id);

        if($user->photo)
            $user -> photo = Storage::url('users_photos/'.$user -> photo);

        return view('user.show',[
            'user' => $user,
            'reservations'              => Reservation::where('user_id' , '=', $id)->get(),
            'entitlements'              => Auth::user()-> auth_level,
            'avaibleUsers'              => User::all(),
            'qualifications'            => Qualification::all(),
            'selectedQualifications'    => DB::table('qualification_user')->where('user_id', $id)->get(),
            'userJobs'                  => Job::where('jobs.user_id' , $id)
                                            ->join('vehicles', 'vehicles.id', '=', 'jobs.vehicle_id')
                                            ->select('jobs.*', 'vehicles.id as vehicle_id', 'vehicles.name')
                                            ->get(),
        ]);
    }

    public function userToEdit($id){
        return view('user.edit', [
            'user'                      => User::findOrFail($id),
            'qualifications'            => Qualification::all(),
            'selectedQualifications'    => DB::table('qualification_user')->where('user_id', $id)->get(),
        ]);
    }

    public function prepareAdd(){
        return view('user.add', [
            'entitlements'   => Auth::user()-> auth_level,
            'qualifications' => Qualification::all(),
        ]);
    }

    public function updateUser(Request $request, $id){

        $updateUser = User::find($id);
        $updateUser->name = $request->name;
        $updateUser->last_name = $request->last_name;
        $updateUser->status = $request->status;
        $updateUser->email = $request->email;
        //$updateUser->driving_licence_category = $request->driving_licence_category;
        $updateUser -> auth_level = $request -> auth_level;

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $new_file = $request->file('photo');
            $file_path = $new_file->store('users_photos');

            $updateUser->photo = $request->photo->hashName();
        }

        try {
            $updateUser->save();
            $code = 200;
            $message = 'Użytkownik został zaktalizowany';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
        }

        return redirect('/user/' . $updateUser->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

    public function showAll(){
        return view('user.list', [
            'users' => User::all()->load('qualifications')->sortBy("created_at"),
            'entitlements' => Auth::user()-> auth_level,
        ]);
    }

    public function store(UserStoreRequest $request){
        $validated = $request->validated();
        $qualifications = Qualification::find($validated['driving_licence_category']);
        unset($validated['driving_licence_category']);

        /** @var User $newUser */
        $newUser = User::create($validated);
        $newUser->qualifications()->saveMany($qualifications);

//        $photo_value = null;
        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);

            $new_file = $request->file('photo');
            $file_path = $new_file->store('users_photos');

            $photo_value = $request->photo->hashName();
            $newUser->photo = $photo_value;
        }

        $newUser->password = Hash::make($request->password);


        try {
            $newUser->save();
            $code = 200;
            $message = 'Użytkownik został dodany';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
        }

        return redirect('/user/' . $newUser->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
    }


    public function isQualified(Request $request)
    {
        return $this->rentalService->verifyQualification(Auth::user(),Vehicle::find($request->vehicle_id));
    }

    public function delete(Request $request)
    {
        if( isset($request->user_id)){
            $user = User::find($request->user_id);
            try {
                $user->delete();
                $code = 200;
                $message = 'Użytkownik został usunięty';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        }
        return redirect()->route('user-show-all')
        ->with('return_code', $code)
        ->with('return_message', $message);
    }
}
