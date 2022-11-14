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
        $incident = Incident::findOrFail($id);
        $incident -> photo = Storage::url('incidents_photos/'.$incident -> photo);
        return view('incident.show', [
            'incident' => $incident,
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
            $file_path = $new_file->store('incidents_photos');
 
            $incident = new Incident([
                "date" =>  new \DateTimeImmutable($request->date??now()),
                "description" => $request->get('description'),
                "photo" => $request->photo->hashName(),
                "address" => $request->get('address'),
                "status" => 'unprocessed',
                "vehicle_id" => $request->get('vehicle_id'),
            ]);

            try{
                $incident->save();
                $code = 200;
                $message = 'Zdarzenie zostało dodane';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
                return redirect()->back()
                ->with('return_code', $code)
                ->with('return_message', $message);
            }
            
        }else{
            $code = 500;
            $message = 'Brak zdjęcia lub złe rozszerzenie';
        }

        return redirect('/incident/' . $incident->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
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

    public function prepareEdit($id){

        $incident = Incident::findOrFail($id);
        $car = Vehicle::where('id', $incident->vehicle_id)->first();
        return view('incident.edit', [
            'incident' => Incident::findOrFail($id),
            'vehicles' => Vehicle::all(),
            'thisCar'  => $car 
        ]);
    }

    public function edit(Request $request, $id){
        $updateIncident = Incident::find($id);
        $updateIncident->updated_at = new \DateTimeImmutable(now());
        $updateIncident->date = new \DateTimeImmutable($request->date);
        $updateIncident->description = $request->input('description');
        $updateIncident->address = $request->input('address');
        $updateIncident->status = $request->input('status');
        $updateIncident->vehicle_id = $request->input('vehicle_id');

        try{
            $updateIncident->update();
            $code = 200;
            $message = 'Zdarzenie zostało zaktualizowane';
        } catch (\Throwable $th) {
            $code = 400;
            $message = $th->getMessage();
            return redirect()->back()
            ->with('return_code', $code)
            ->with('return_message', $message);
        }

        return redirect('/incident/' . $updateIncident->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

    public function delete(Request $request)
    {
        if( isset($request->incydent_id)){
            try{
            $incydent = Incident::find($request->incydent_id);
            $incydent->delete();
            $code = 200;
            $message = 'Zdarzenie zostało usunięte';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        }else{return redirect()->back();}
        
        return redirect()->route('showAllIncidents')
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

}
