<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function showAll(){
        return view('service.list', ['services' => Service::all()->sortBy("created_at")]);
    }

}
