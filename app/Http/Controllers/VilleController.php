<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use Illuminate\Support\Facades\DB;


class VilleController extends Controller
{
    public function get_villes()
    {
        $villes = Ville::all();
        $passengerId = auth()->id();

       $mostReservedtrajets = DB::table('reservations')
        ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
        ->join('trajets', 'taxi_trajet.trajet_id', '=', 'trajets.id')
        ->join('villes as departure', 'trajets.depart_id', '=', 'departure.id')
        ->join('villes as destination', 'trajets.destination_id', '=', 'destination.id')
        ->where('reservations.passenger_id', $passengerId)
        ->select('departure.ville as departure_city', 'destination.ville as destination_city', DB::raw('COUNT(*) as reservations_count'))
        ->groupBy('departure.ville', 'destination.ville')
        ->orderByDesc('reservations_count')
        ->limit(2)
        ->get();
        
        return view('passenger.dashboard_p', compact('villes','mostReservedtrajets'));

    }
    public function testadmin()
    {
        return view("admin.dashboard_a");
    }
}
