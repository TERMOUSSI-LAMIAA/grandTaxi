<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Controllers\ReservationsController;

class UserController extends Controller
{
    public function getPassengers()
    {
        $passengers = User::where('type_user', 'passenger')->where('is_admin', 0)->get();
      
        return view("admin.gestionP",compact("passengers"));

    }
    public function getDrivers(){
        $drivers = User::where('type_user', 'driver')->get();
        return view("admin.gestionD",compact("drivers"));
    }
    public function get_reservations(){
        $reservationsData =ReservationsController::getReservation();

        $newReservations = $reservationsData['newReservations'];
        $oldReservations = $reservationsData['oldReservations'];
    
        return view('admin.gestionR', compact('newReservations', 'oldReservations'));
    }
    
    public function deletePassenger(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();


        return redirect()->route('admin.gestionP')->with('success', 'passenger deleted successfully.');
    }
}
