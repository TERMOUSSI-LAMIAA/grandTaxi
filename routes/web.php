<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\TaxiTrajetController;
use App\Http\Controllers\ReservationsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard_d', [TrajetController::class, 'get_trajets'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard_d');

Route::get('/dashboard_p', [VilleController::class, 'get_villes'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard_p');

Route::get('/dashboard_a', [VilleController::class, 'testadmin'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard_a');

Route::post('dashboard_d', [TrajetController::class, 'addUserTrajets'])->name('addUserTrajets');
Route::get('/search', [TaxiTrajetController::class, 'searchTaxiTrajet'])->name('search');
Route::get('/reservations', [ReservationsController::class, 'getReservations'])->name('mesReservations');
Route::post('/reserve/{taxiTrajetId}', [ReservationsController::class, 'reserve'])->name('reserve');
Route::put('/evaluate/{reservationId}', [ReservationsController::class, 'evaluate'])->name('evaluate');
Route::delete('/cancel/{reservationId}', [ReservationsController::class, 'cancelReservation'])->name('cancelReservation');


require __DIR__ . '/auth.php';

// Route::get('/dashboard_d', [TrajetController::class, 'get_trajets'])
//     ->middleware(['auth', 'verified'])
//     ->name('gettrajet');


// Route::get('/dashboard', [VilleController::class, 'get_villes'])->name('passengerHome');

// Route::get('/driver/dashboard_d', [TrajetController::class, 'get_trajets'])->name('dashboard_d');
// Route::post('dashboard_d', [TrajetController::class, 'get_trajets'])->name('trajet');
// --