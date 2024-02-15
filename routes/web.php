<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\TrajetController;
use App\Http\Controllers\VilleController;



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

require __DIR__ . '/auth.php';

Route::get('/dashboard', [TrajetController::class, 'get_trajets'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::get('/driver/dashboard_d', [TrajetController::class, 'get_trajets'])->name('dashboard_d');
// Route::post('/driver/dashboard_d', [TrajetController::class, 'get_trajets'])->name('trajet');
// --
Route::get('dashboard', [VilleController::class, 'get_villes'])->name('passengerHome');
Route::get('/search', [TrajetController::class, 'searchTaxiTrajet'])->name('search');