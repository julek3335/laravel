<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncidentController;

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

Route::get('/vehicles', function () {
    return view('vehicles');
})->middleware(['auth'])->name('dashboard');

Route::get('/example-car', function () {
    return view('car');
})->middleware(['auth'])->name('dashboard');

Route::get('/user-rights', function () {
    return view('user-rights');
})->middleware(['auth'])->name('dashboard');

Route::get('/create-user', function () {
    return view('create-user');
})->middleware(['auth'])->name('dashboard');

Route::get('/user{id}', [UserController::class, 'show']);

Route::get('/incident', [IncidentController::class, 'show']);

Route::get('/incident-create', function () {
    return view('incident.create');
});

Route::post('/incident-create', [IncidentController::class, 'store']);



require __DIR__.'/auth.php';
