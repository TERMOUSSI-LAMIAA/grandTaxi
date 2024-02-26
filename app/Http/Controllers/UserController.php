<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

// 
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
        // $reservationsData =ReservationsController::getReservation();
  
        // $newReservations = $reservationsData['newReservations'];
        // $oldReservations = $reservationsData['oldReservations'];
        $reserv=Reservation::all();

        return view('admin.gestionR', compact('reserv'));
    }
    
    public function deleteUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('deleteUser')->with('success', 'passenger deleted successfully.');
    }
    public function calculUsers(){
        $passengerCount = User::where('type_user', 'passenger')->where('is_admin',0)->count();  
        $driverCount = User::where('type_user', 'driver')->count();  
        
       
        return view('admin.dashboard_a',compact("passengerCount","driverCount"));
    }
}
