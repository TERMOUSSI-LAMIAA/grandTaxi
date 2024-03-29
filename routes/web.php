<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\TaxiTrajetController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\UserController;



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

Route::get('/dashboard_a', [UserController::class, 'calculUsers'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard_a');

Route::post('dashboard_d', [TrajetController::class, 'addUserTrajets'])->name('addUserTrajets');
Route::get('/reservations', [ReservationsController::class, 'getReservations'])->name('mesReservations');
Route::get('/search', [TaxiTrajetController::class, 'searchTaxiTrajet'])->name('search');
Route::get('/orderbyprice', [TaxiTrajetController::class, 'orderByPrice'])->name('order_by_price');
Route::post('/reserve/{taxiTrajetId}', [ReservationsController::class, 'reserve'])->name('reserve');
Route::put('/evaluate/{reservationId}', [ReservationsController::class, 'evaluate'])->name('evaluate');
Route::delete('/cancel/{reservationId}', [ReservationsController::class, 'cancelReservation'])->name('cancelReservation');
Route::get('/gestPassenger', [UserController::class, 'getPassengers'])->name('gestPassenger');
Route::get('/gestDriver', [UserController::class, 'getDrivers'])->name('gestDriver');
Route::get('/gestReservations', [UserController::class, 'get_reservations'])->name('gestReservationsAdmin');
Route::delete('/gestUser/{userId}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::delete('/gestReservations.delet/{reservationId}', [ReservationsController::class, 'deleteReservation'])->name('deleteReservation');

require __DIR__ . '/auth.php';

