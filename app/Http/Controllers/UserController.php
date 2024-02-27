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
        foreach ($user->taxi->taxiTrajets as $taxiTrajet) {
            $taxiTrajet->reservations()->delete();
            $taxiTrajet->delete();
        }
        $user->taxi()->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Driver deleted successfully.');
    }
    public function calculUsers(){
        $passengerCount = User::where('type_user', 'passenger')->where('is_admin',0)->count();  
        $driverCount = User::where('type_user', 'driver')->count();  
       
        $maxAverageRates = DB::table('reservations')
        ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
        ->join('taxis', 'taxi_trajet.taxi_id', '=', 'taxis.id')
        ->join('users', 'taxis.user_id', '=', 'users.id')
        ->select('users.id', 'users.name', DB::raw('AVG(reservations.rating) as average_rate'))
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('average_rate')
        ->first();
   
        $minAverageRateUser = DB::table('reservations')
        ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
        ->join('taxis', 'taxi_trajet.taxi_id', '=', 'taxis.id')
        ->join('users', 'taxis.user_id', '=', 'users.id')
        ->select('users.id', 'users.name', DB::raw('AVG(reservations.rating) as average_rate'))
        ->groupBy('users.id', 'users.name')
        ->orderBy('average_rate')
        ->first();
       
        return view('admin.dashboard_a',compact("passengerCount","driverCount","maxAverageRates","minAverageRateUser"));
    }
}
