<?php
 
namespace App\Http\Controllers;
// use Illuminate\Support\Facades\DB;
// use App\Models\Post;
use Illuminate\Http\Request;

use App\Models\User;
 
class UserController extends Controller
{
    public function show($id){
        return view('user', User::findOrFail($id));
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
        $updateUser->update();
        return view('user', User::findOrFail($id));
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
       $newUser -> save();
       $id = $newUser -> id;
       return view('user', User::findOrFail($id));
    }
}