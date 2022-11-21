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
use App\Models\Job;

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
    Route::get('/vehicles/delete/{vehicle_id}', 'delete')->middleware(['auth'])->name('vehiclesDelete');;
    Route::get('/vehicles', 'showAll')->middleware(['auth'])->name('showAllVehicles');;
    Route::get('/vehicles/{id}', 'show')->middleware(['auth'])->name('dashboard');;
    Route::get('/vehicle/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/vehicle/add', 'store');
    Route::get('/vehicle/edit/{id}', 'edit');
    Route::post('/vehicle/edit/{id}', 'updateVehicle');
    Route::post('/vehicle/{id}/delete/photo/{name}', 'deleteVehiclePhoto');
    Route::get('/calendar/{id}', 'showCalendar')->middleware(['auth'])->name('dashboard');;
});


Route::controller(JobController::class)->group(function () {
    Route::post('/rent', 'startJob')->middleware(['auth'])->name('dashboard');
    Route::get('/jobs/{id}', 'show')->middleware(['auth'])->name('dashboard');
    Route::post('/jobs/{job_id}/end', 'endJob')->middleware(['auth'])->whereNumber('job_id');
    Route::get('/jobs', 'showAll')->middleware(['auth'])->name('dashboard');
    Route::get('/jobs/vehicle', 'listVehicleJobs')->name('dashboard');
//    Route::get('/rent/{vehicleId}/{userId}', 'startJob')->name('dashboard');;
});
Route::get('/example-car', function () {
    return view('car');
})->middleware(['auth'])->name('dashboard');

Route::controller(InsuranceController::class)->group(function(){
    Route::get('/insurance/delete/{insurance_id}', 'delete')->middleware(['auth'])->name('deleteInsurance');
    Route::get('/insurance', 'showAll')->middleware(['auth'])->name('showAllInsurances');
    Route::get('/insurance/{insurance_id}', 'show')->middleware(['auth'])->name('show');
    Route::get('/insurance/edit/{id}', 'edit');
    Route::post('/insurance/edit/{id}', 'updateInsurance');
    Route::get('/add-new', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/add-new', 'create')->middleware(['auth'])->name('dashboard');
});

Route::controller(IncidentController::class)->group(function () {
    Route::get('/incidents/delete/{incident_id}', 'delete')->middleware(['auth'])->name('deleteIncident');
    Route::get('/incidents', 'showAll')->middleware(['auth'])->name('showAllIncidents');
    Route::get('/incident/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/incident/add', 'store');
    Route::get('/incident/{id}', 'show')->middleware(['auth'])->name('dashboard');
    Route::get('/incident/edit/{id}', 'prepareEdit')->middleware(['auth'])->name('dashboard');
    Route::post('/incident/edit/{id}', 'edit')->middleware(['auth'])->name('dashboard');

});

Route::controller(UserController::class)->group(function () {
    Route::get(' /user/showProfile', 'showCurrentProfile')->middleware(['auth'])->name('dashboard');
    Route::get('/users/delete/{user_id}', 'delete')->middleware(['auth'])->name('deleteUser');
    Route::get('/user/add', 'prepareAdd')->middleware(['auth'])->name('dashboard');
    Route::post('/user/add', 'store')->middleware(['auth'])->name('dashboard');
    Route::get('/users', 'showAll')->name('showAllUsers');
    Route::get('/user/{id}', 'show')->middleware(['auth'])->name('dashboard');
    Route::post('/user/edit/{id}', 'updateUser')->middleware(['auth'])->name('dashboard');
    Route::get('/user/edit/{id}', 'userToEdit')->middleware(['auth'])->name('dashboard');
});

Route::controller(ReservationController::class)->group(function () {
    Route::get('/reservation/available-cars', 'getAvailableCars')->middleware(['auth']);
    Route::post('/reservation-create', [ReservationController::class, 'created']);
    Route::get('/reservations', 'showAll')->middleware(['auth'])->name('dashboard');
    Route::get('/reservations/all/calendar', 'showAllReservationsCalendar')->middleware(['auth'])->name('dashboard');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('/services/delete/{service_id}', 'delete')->middleware(['auth'])->name('deleteService');
    Route::get('/services', 'showAll')->middleware(['auth'])->name('showAllServices');
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

Route::get('/route',[JobController::class, 'route']);



require __DIR__.'/auth.php';
