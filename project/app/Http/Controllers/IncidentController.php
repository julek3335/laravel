<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class IncidentController extends Controller
{
    public function show($id)
    {
        return view('incident.show', [
            'incident' => $incident = Incident::findOrFail($id),
            'vehicle'  => Vehicle::findOrFail($incident->vehicle_id)
        ]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            
            $new_file = $request->file('photo');
            $file_path = $new_file->store('incidents_photos', 'public');
 
            $incident = new Incident([
                "date" =>  new \DateTimeImmutable($request->date??now()),
                "description" => $request->get('description'),
                "photo" => $request->photo->hashName(),
                "address" => $request->get('address'),
                "status" => 'unprocessed',
                "vehicle_id" => $request->get('vehicle_id'),
            ]);

            $incident->save();
            
            return redirect('/incident/' . $incident->id);
        }

        echo "Error - probably no photo or wrong photo extension";
    }

    /*
    ** Show all incidents and return view
    */
    public function showAll(){
        return view('incident.list', ['incidents' => Incident::all()->sortBy("created_at")]);
    }

    public function prepareAdd(){
        return view('incident.add', ['vehicles' => Vehicle::all()]);
    }

    public function delete(Request $request)
    {
        if( isset($request->incydent_id)){
            $incydent = Incident::find($request->incydent_id);
            $incydent->delete();
        }
        return redirect()->route('showAllIncidents');
    }

}
