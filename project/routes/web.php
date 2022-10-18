<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'showAll')->middleware(['auth'])->name('dashboard');;
    Route::get('/vehicles/{id}', 'show')->middleware(['auth'])->name('dashboard');;
    //Route::post('/orders', 'store');
});

Route::controller(JobController::class)->group(function () {
    Route::get('/rent/{vehicleId}/{userId}', 'startJob')->name('dashboard');;

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

require __DIR__.'/auth.php';
