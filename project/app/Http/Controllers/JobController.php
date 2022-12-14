<?php

namespace App\Http\Controllers;

use App\Enums\UserStatusEnum;
use App\Enums\VehicleStatusEnum;
use phpGPX\phpGPX;
use App\Models\Job;
use App\Models\User;
use App\Models\Vehicle;
use App\Enums\JobStatusEnum;
use Illuminate\Http\Request;
use App\Http\Requests\EndJobRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StartJobRequest;
use App\Services\VehicleRentalService;
use Illuminate\Support\Facades\Storage;

use phpGPX\Models\GpxFile;
use phpGPX\Models\Link;
use phpGPX\Models\Metadata;
use phpGPX\Models\Point;
use phpGPX\Models\Segment;
use phpGPX\Models\Track;

// require_once '/vendor/autoload.php';

class JobController extends Controller
{

    private VehicleRentalService $rentalService;

    public function __construct(VehicleRentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    public function startJob(StartJobRequest $request)
    {
        $jobData = [
            'start_point' => $request->start_localization,
            'end_point' => $request->end_localization,
            'start_odometer' => $request->start_odometer,
            'start_time' => new \DateTimeImmutable($request->start_time),
        ];

        try{
            $job = $this->rentalService->rentVehicle($request->vehicle_id, Auth::user()->id, $jobData);
        } catch (\Error $error){
            return redirect('/jobs' )
                ->with('return_code', $error->getCode())
                ->with('return_message', $error->getMessage());
        }

        if ($job !== null) {
            $code = 200;
            $message = 'Trasa została rozpoczęta';
            return redirect('/jobs/' . $job->id)
                ->with('return_code', $code)
                ->with('return_message', $message);
        } else {
            $code = 400;
            $message = 'Nie udało się rozpocząć trasy';
            return redirect('/jobs' )
                ->with('return_code', $code)
                ->with('return_message', $message);
        }

    }

    public function endJob(EndJobRequest $request)
    {
        $job = $this->rentalService->finishJob($request);
        if($job->save()){
            $code = 200;
            $message = 'Trasa została zakończona';
        } else {
            $code = 400;
            $message = 'Wystąpił błąd przy zapisie trasy';
        }

        return redirect('/jobs/' . $job->id)
        ->with('return_code', $code)
        ->with('return_message', $message);
    }

    public function listVehicleJobs(Request $request)
    {
        return Job::where('vehicle_id', $request->vehicle_id)->get();
    }

    public function show($id)
    {
        /** @var Job $job */
        $job = Job::findOrFail($id);

        if($job->route_file)
            $job->route_file = Storage::url('routes_files/'.$job->route_file);

        $job->load(['user', 'vehicle']);
        return view('job.show', ['job' => $job]);
    }

    public function showAll()
    {
        $jobs = Job::all()->sortBy("created_at");
        $jobs->load(['user', 'vehicle']);
        return view('job.list', ['jobs' => $jobs]);
    }

    public function route(Request $request){

        error_log('enter route');

        $id = $request->id;
        $gpx_data = $request->gpx_data;

        if( is_null($gpx_data) )
        {
            error_log('request is empty');
            return "error request is empty";}

        // dd($gpx_data);


        $job = Job::findOrFail($id);
        if( is_null( $job->route_file ) ){
            error_log('start creatin new file');

            // GpxFile contains data and handles serialization of objects
            $gpx_file = new GpxFile();
            // Creating sample Metadata object
            $gpx_file->metadata = new Metadata();
            $gpx_file->metadata->time = new \DateTime();
            $gpx_file->metadata->description = "GPX file, created using ipojazd.pl";
            // Creating track
            $track = new Track();
            // Name of track
            $track->name = "route_file".$id;
            $track->type = 'RUN';
            $track->source = "iPojazd.pl";

            $track->recalculateStats();
            // Add track to file
            $gpx_file->tracks[] = $track;


            $filename = sha1("route".$id).".gpx";
            $path = "routes_files/".$filename;
            $document = $gpx_file->toXML();
            $string = $document->saveXML();
            Storage::disk(env("FILESYSTEM_DISK"))->put($path, $string);


            //save filename to Job
            $job -> route_file = $filename;

            try {
                $job -> update();
                $code = 200;
                $message = 'Trasa została utworzona';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        error_log('end creating route file');


            // return Storage::url('routes_files/'.$job -> route_file);
        }

        error_log('start adding points');

        ///if file allready exists

        $gpx = new phpGPX();

        $url = Storage::url('routes_files/'.$job -> route_file);

        // $gpx_file = $gpx->load($url);
        if(env("FILESYSTEM_DISK") == "public"){$gpx_file = $gpx->load('storage/routes_files/'.$job -> route_file);}
        if(env("FILESYSTEM_DISK") == "azure"){$gpx_file = $gpx->load($url);}


        // get last track from file
        $track = end($gpx_file->tracks);

        error_log('last track');

        // create new segment
        $segment = new Segment();


        foreach ($gpx_data as $gpx_point)
        {
            // Creating trackpoint
            $point = new Point(Point::TRACKPOINT);
            $point->latitude = $gpx_point['latitude'];
            $point->longitude = $gpx_point['longitude'];
            // $point->elevation = $gpx_point['elevation'];
            // $point->time = $gpx_point['time'];

            $segment->points[] = $point;
        }

        $track->segments[] = $segment;

        // Recalculate stats based on received data
        $track->recalculateStats();


        $path = "routes_files/".$job -> route_file;
        $document = $gpx_file->toXML();
        $string = $document->saveXML();

        try{
            Storage::disk(env("FILESYSTEM_DISK"))->put($path, $string);
            error_log('punkty zapsane');

        }catch(\Throwable $th){error_log('punkty zapsane'.$th);}

        //save filename to Job
        // $job -> route_file = "route".$id.".gpx";

        return Storage::url('routes_files/'.$job -> route_file);

    }
}
