<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', DashboardController::class)->middleware(['auth'])->name('dashboard');;
});

Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'showAll')->middleware(['auth'])->name('dashboard');;
    Route::get('/vehicles/{id}', 'show')->middleware(['auth'])->name('dashboard');;
    Route::get('/calendar/{id}', 'showCalendar')->middleware(['auth'])->name('dashboard');;

});

Route::get('/example-car', function () {
    return view('car');
})->middleware(['auth'])->name('dashboard');

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'showAll')->middleware(['auth'])->name('dashboard');;
    Route::get('/user/{id}', 'show')->middleware(['auth'])->name('dashboard');;
    Route::post('/users', [UserController::class, 'created']);
    Route::put('/edit-user/{id}', [UserController::class, 'updateUser']);
    Route::get('/edit-user/{id}', 'userToEdit')->middleware(['auth'])->name('dashboard');;
});

Route::get('/create-user', function () {
    return view('create-user');
})->middleware(['auth'])->name('dashboard');

Route::get('/reservations', function () {
    return view('reservations');
})->middleware(['auth'])->name('dashboard');

// Route::get('/user{id}', [UserController::class, 'show']);

Route::get('/incident', [IncidentController::class, 'show']);

Route::get('/incident-create', function () {
    return view('incident.create');
});

Route::get('/incident-show{id}', [IncidentController::class, 'show']);

Route::post('/incident-create', [IncidentController::class, 'store']);

Route::get('/reservation-create', function () {
    return view('reservation.create');
});

Route::post('/reservation-create', [ReservationController::class, 'created']);

Route::get('/reservation-getuser', function () {
    return view('reservation.getUserReservations');
});

Route::post('/reservation-getuser', [ReservationController::class, 'showUserReservations']);

Route::get('/reservation-getvehicle', function () {
    return view('reservation.getVehicleReservations');
});

Route::post('/reservation-getvehicle', [ReservationController::class, 'showVehicleReservations']);



require __DIR__.'/auth.php';
