<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    public function show($id)
    {
        $incidents = DB::select('select * from incidents where id = ?', array($id));

        return view('incident.show', ['incidents' => $incidents]);
    }

    public function store(Request $request)
    {
        $incident = new Incident([
            "date" => $request->get('date'),
            "description" => $request->get('description'),
            "photo" => $request->get('photo'),
            "address" => $request->get('address'),
            "vehicle_id" => $request->get('vehicle_id'),
        ]);

        $incident->save();

        return view('dashboard');
    }
}
