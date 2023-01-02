<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ReservationCreatedRequest;

class ReservationController extends Controller
{
    public function show($id)
    {
        return view('reservation.show', Reservation::findOrFail($id));
    }

    public function showAll(){
        // te nazwy widokow to sobie tak z dupy wymyslam, nie mam nic zsczegolnego na mysli
        return view('reservation.showVehicleReservations', [
            'reservations' => Reservation::all()->sortBy("created_at"),
            'availableVehicles' => Vehicle::all(),
            'entitlements' => Auth::user()-> auth_level,
            'avaibleUsers' => User::all()
        ]);
    }

    public function showUserReservations(Request $req){
        // jezeli poziom uzytkownika edytor lub admin pobiera userId z widoku jezeli poziom uzytkownik pobiera id obecnie zalogowanego uzytkownika
        if(Auth::user()-> auth_level == 0 || Auth::user()-> auth_level ==1)
        {
            $user_id = $req -> user_id;
        }else{
            $user_id = Auth::user() -> id;
        }

        return view('reservation.showUserReservations', ['reservations' => Reservation::all()->where('user_id', $user_id)]);

    }

    public function showVehicleReservations(Request $req)
    {
        return view('reservation.showVehicleReservations', ['reservations' => Reservation::all()->where('vehicle_id', $req -> vehicle_id)]);
    }

    public function created(ReservationCreatedRequest $req){

        // jezeli poziom uzytkownika edytor lub admin pobiera userId z widoku jezeli poziom uzytkownik pobiera id obecnie zalogowanego uzytkownika
        if(Auth::user()-> auth_level == 0 || Auth::user()-> auth_level ==1)
        {
            $user_id = $req -> user_id;
            $driving_licence_category = User::findOrFail($user_id) -> driving_licence_category;
        }else{
            $driving_licence_category = Auth::user() -> driving_licence_category;
            $user_id = Auth::user() -> id;
        }

        // sprawdzenie czy dany uzytkownik moze kierowac danym pojazdem
        // na razie nie aktywne brak kategoi pojazdu w bd
        // if($driving_licence_category != Vehicle::findOrFail($req -> vehicle_id) -> category)
        // {
        //     return ('Wrong category');
        // }

        $current_reservations = Reservation::all()->where('vehicle_id', $req -> vehicle_id);
        $new_reservation_start_date = $req -> start_date;
        $new_reservation_end_date = $req -> end_date;

        if( $current_reservations->isEmpty() == 'true')
        {
            $flag = "valid";
        }

        foreach ($current_reservations as $current_reservation)
        {
            $current_reservation_start_date = $current_reservation -> start_date;
            $current_reservation_end_date = $current_reservation -> end_date;

            if ( $new_reservation_end_date < $current_reservation_start_date || $current_reservation_end_date < $new_reservation_start_date )
            {
                $flag = "valid";
            }else{
                $flag = "invalid";
                $message = "Ten pojazd jest zajęty";
            }
        }

        if ($flag == "valid") {
            $newReservation = new Reservation;
            $newReservation->start_date = $req->start_date;
            $newReservation->end_date = $req->end_date;
            $newReservation->user_id = $user_id;
            $newReservation->vehicle_id = $req->vehicle_id;
            $newReservation->save();
            $code = 200;
            $message = 'Rezerwacja została dodana';
            $id = $newReservation->id;

            return redirect()->route('reservation-calendar-all')
                ->with('return_code', $code)
                ->with('return_message', $message);
        } else {
            return redirect('/')
                ->with('return_code', 500)
                ->with('return_message', $message);
        }

     }

    public function showAllReservationsCalendar()
    {
        $reservations = Reservation::
        select('reservations.start_date AS start_date', 'reservations.end_date AS end_date', 'users.name AS user_name', 'users.last_name AS user_last_name', 'reservations.user_id AS user_id', 'reservations.vehicle_id AS vehicle_id', 'vehicles.name AS vehicle_name', 'vehicles.license_plate AS license_plate')
        ->join( 'users', 'reservations.user_id', '=', 'users.id')
        ->join('vehicles', 'reservations.vehicle_id', '=', 'vehicles.id')
        ->get();
        return view('reservation.showCalendar', ['reservations' => $reservations]);
    }

    public function getAvailableCars(Request $request)
    {
        $startTime = new \DateTimeImmutable($request->start_time);

        $reservedIds = Reservation::whereDate('start_date', '<=', $startTime)
            ->whereDate('end_date', '>=', $startTime)
            ->get('vehicle_id')
            ->pluck('vehicle_id');
        $cars = Vehicle::whereNotIn('id',$reservedIds->all())->get();
        return response()->json($cars->all());
    }

    public function delete(Request $request): RedirectResponse
    {
        if( isset($request->reservation_id)){
            $reservation = Reservation::find($request->reservation_id);
            try {
                $reservation->delete();
                $code = 200;
                $message = 'Usunięto rezerwację';
            } catch (\Throwable $th) {
                $code = 400;
                $message = $th->getMessage();
            }
        }
        return redirect()->route('Reservations')
            ->with('return_code', $code)
            ->with('return_message', $message);
    }
}
