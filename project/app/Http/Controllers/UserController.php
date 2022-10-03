<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\User;
 
class UserController extends Controller
{
    public function show($id){
        return view('user', User::findOrFail($id));
    }

    public function showAll(){
        return view('users', ['users' => User::all()->sortBy("created_at")]);
    }
}