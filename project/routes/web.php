<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ServiceEventController;
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


Route::group(['middleware'=>'auth'],function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
    });

    Route::controller(VehicleController::class)->group(function () {
        Route::group(['middleware'=>'role:1'], function(){
            Route::get('/vehicles/delete/{vehicle_id}', 'delete')->name('vehiclesDelete');
            Route::get('/vehicle/add', 'prepareAdd')->name('vehicle-prepare-add');
            Route::post('/vehicle/add', 'store');
            Route::get('/vehicle/edit/{id}', 'edit');
            Route::post('/vehicle/edit/{id}', 'updateVehicle');
            Route::post('/vehicle/{id}/delete/photo/{name}', 'deleteVehiclePhoto');
        });
        Route::get('/vehicles', 'showAll')->name('vehicle-show-all');
        Route::get('/vehicles/{id}', 'show')->name('vehicle-details');
        Route::get('/calendar/{id}', 'showCalendar')->name('vehicle-calendar-show');
    });

    Route::controller(ServiceEventController::class)->group(
        function () {
            Route::post('/service/event/finish', 'finishServiceEvent')->name('service-event-finish');
        }
    );

    Route::controller(JobController::class)->group(function () {
        Route::post('/rent', 'startJob')->name('job-start');
        Route::get('/jobs/{id}', 'show')->name('job-details');
        Route::post('/jobs/{job_id}/end', 'endJob')->whereNumber('job_id')->name('job-end');
        Route::get('/jobs', 'showAll')->name('job-show-all');
        Route::get('/jobs/vehicle', 'listVehicleJobs')->name('job-show-all-for-vehicle');
        Route::post('/route/{id}', 'route')->whereNumber('id');
    });

    Route::controller(InsuranceController::class)->group(function(){
        Route::group(['middleware'=>'role:1'], function(){
            Route::get('/insurance/delete/{insurance_id}', 'delete')->name('insurance-delete');
            Route::get('/insurance/edit/{id}', 'edit');
            Route::post('/insurance/edit/{id}', 'updateInsurance');
            Route::get('/add-new', 'prepareAdd')->name('insurance-prepare-add');
            Route::post('/add-new', 'create')->name('insurance-add');
        });
        Route::get('/insurance', 'showAll')->name('insurance-show-all');
        Route::get('/insurance/{insurance_id}', 'show')->name('insurance-details');
    });

    Route::controller(IncidentController::class)->group(function () {
        Route::group(['middleware'=>'role:1'], function(){
            Route::get('/incidents/delete/{incident_id}', 'delete')->name('incident-delete');
            Route::get('/incident/edit/{id}', 'prepareEdit')->name('incident-prepare-edit');
            Route::post('/incident/edit/{id}', 'edit')->name('incident-edit');
        });
        Route::get('/incidents', 'showAll')->name('incident-show-all');
        Route::get('/incident/add', 'prepareAdd')->name('incident-prepare-add');
        Route::post('/incident/add', 'store');
        Route::get('/incident/{id}', 'show')->name('incident-details');
    });


    Route::controller(UserController::class)->group(function () {
        Route::group(['middleware'=>'role:0'], function(){
            Route::get('/users/delete/{user_id}', 'delete')->name('user-delete');
            Route::get('/user/add', 'prepareAdd')->name('user-prepare-add');
            Route::post('/user/add', 'store')->name('user-add');
            Route::post('/user/edit/{id}', 'updateUser')->name('user-update');
            Route::get('/user/edit/{id}', 'userToEdit')->name('user-edit-show');
        });
        Route::get(' /user/showProfile', 'showCurrentProfile')->name('user-current-detail');
        Route::get('/users', 'showAll')->name('user-show-all');
        Route::get('/user/{id}', 'show')->name('user-detail');
    });

    Route::controller(ReservationController::class)->group(function () {
        Route::group(['middleware'=>'role:1'], function(){
            Route::delete('/reservations/{reservation_id}', 'delete')->name('reservation-delete');
        });
        Route::get('/reservation/available-cars', 'getAvailableCars')->name('reservation-available-cars');
        Route::post('/reservation-create', 'created')->name('reservation-create');
        Route::get('/reservations', 'showAll')->name('reservation-show-all');
        Route::get('/reservations/all/calendar', 'showAllReservationsCalendar')->name('reservation-calendar-all');
    });

    Route::controller(ServiceController::class)->group(function () {
        Route::group(['middleware'=>'role:1'], function(){
            Route::get('/services/delete/{service_id}', 'delete')->name('service-delete');
            Route::get('/service/add', 'prepareAdd')->name('service-prepare-add');
            Route::post('/service/add', 'store')->name('service-add');
            Route::get('/service/edit/{id}', 'prepareEdit')->name('service-prepare-edit');
            Route::put('/service/edit/{id}', 'update')->name('service-edit');
        });
        Route::get('/services', 'showAll')->name('service-show-all');
        Route::get('/service/{id}', 'show')->name('service-detail');
    });
});


require __DIR__.'/auth.php';
