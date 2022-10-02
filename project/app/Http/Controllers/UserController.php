<?php
 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\User;
 
class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $users = DB::select('select * from users where id = ?', array($id));

        return view('user', ['users' => $users]);
    }
}