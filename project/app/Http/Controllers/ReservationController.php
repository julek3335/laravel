<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function show($id)
    {
        return view('reservation.show', Reservation::findOrFail($id));
    }

    public function showAll(){
        // te nazwy widokow to sobie tak z dupy wymyslam, nie mam nic zsczegolnego na mysli
        return view('Reservation.showAll', ['reservations' => Reservation::all()->sortBy("created_at")]);
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

    public function created(Request $req){
        
        // jezeli poziom uzytkownika edytor lub admin pobiera userId z widoku jezeli poziom uzytkownik pobiera id obecnie zalogowanego uzytkownika
        if(Auth::user()-> auth_level == 0 || Auth::user()-> auth_level ==1)
        {
            $user_id = $req -> user_id;
            $driving_licence_category = User::findOrFail($user_id) -> driving_licence_category;
        }else{
            $driving_licence_category = Auth::user() -> driving_licence_category;
            $user_id = Auth::user() -> user_id;
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
            }
        }

        if ($flag == "valid")
        {
            $newReservation = new Reservation;
            $newReservation -> start_date = $req -> start_date;
            $newReservation -> end_date = $req -> end_date;
            $newReservation -> user_id = $user_id;
            $newReservation -> vehicle_id = $req -> vehicle_id;
            $newReservation -> save();
            $id = $newReservation -> id;
            return view('Reservation', Reservation::findOrFail($id));

        }else{
            return("This vehicle is already ocupied in this time period. Please try again");
        }

     }
}
