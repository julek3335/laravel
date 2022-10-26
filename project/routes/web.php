<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\ServiceController;
use App\Models\Insurance;

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
    Route::post('/vehicles/delete/{vehicle_id}', 'delete')->middleware(['auth'])->name('vehiclesDelete');;
    Route::get('/vehicles', 'showAll')->middleware(['auth'])->name('showAllVehicles');;
    Route::get('/vehicles/{id}', 'show')->middleware(['auth'])->name('dashboard');;
    Route::get('/vehicle/add', function () {
        return view('vehicle.add');
    })->middleware(['auth'])->name('dashboard');
    Route::post('/vehicle/add', [VehicleController::class, 'store']);
    Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit']);
    Route::post('/vehicle/edit/{id}', [VehicleController::class, 'updateVehicle']);
    Route::get('/calendar/{id}', 'showCalendar')->middleware(['auth'])->name('dashboard');;
});


Route::controller(JobController::class)->group(function () {
    Route::post('/rent', 'startJob')->name('dashboard');
//    Route::get('/rent/{vehicleId}/{userId}', 'startJob')->name('dashboard');;
});
Route::get('/example-car', function () {
    return view('car');
})->middleware(['auth'])->name('dashboard');

Route::controller(InsuranceController::class)->group(function(){
    Route::get('/insurance/create/{id}', 'insuranceToEdit')->middleware(['auth'])->name('dashboard');
    Route::post('/insurance/create-new/{id}', [InsuranceController::class, 'create']);
});

Route::controller(IncidentController::class)->group(function () {
    Route::get('/incidents', 'showAll')->middleware(['auth'])->name('dashboard');
    Route::get('/incident/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/incident/add', 'store');
    Route::get('/incident/{id}', 'show')->middleware(['auth'])->name('dashboard');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/users/delete/{user_id}', 'delete')->middleware(['auth'])->name('deleteUser');
    Route::get('/user/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/user/add', 'store')->middleware(['auth'])->name('dashboard');
    Route::get('/users', 'showAll')->middleware(['auth'])->name('showAllUsers');
    Route::get('/user/{id}', 'show')->middleware(['auth'])->name('dashboard');
    Route::put('/user/edit/{id}', [UserController::class, 'updateUser']);
    Route::get('/user/edit/{id}', 'userToEdit')->middleware(['auth'])->name('dashboard');
});

Route::controller(ReservationController::class)->group(function () {
    Route::post('/reservation-create', [ReservationController::class, 'created']);
    Route::get('/reservations', 'showAll')->middleware(['auth'])->name('dashboard');
    Route::get('/reservations/all/calendar', 'showAllReservationsCalendar')->middleware(['auth'])->name('dashboard');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services', 'showAll')->middleware(['auth'])->name('dashboard');
    Route::get('/service/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/service/add', 'store')->middleware(['auth'])->name('dashboard');
    Route::get('/service/{id}', 'show')->middleware(['auth'])->name('dashboard');
    Route::get('/service/edit/{id}', 'prepareEdit')->middleware(['auth'])->name('dashboard');
    Route::put('/service/edit/{id}', 'update')->middleware(['auth'])->name('dashboard');
});


Route::get('/map', function () {
    return view('map.show');
});

Route::get('/reservation-create', function () {
    return view('reservation.create');
});

Route::get('/reservation-getuser', function () {
    return view('reservation.getUserReservations');
});

Route::post('/reservation-getuser', [ReservationController::class, 'showUserReservations']);

Route::get('/reservation-getvehicle', function () {
    return view('reservation.getVehicleReservations');
});

Route::post('/reservation-getvehicle', [ReservationController::class, 'showVehicleReservations']);



require __DIR__.'/auth.php';
