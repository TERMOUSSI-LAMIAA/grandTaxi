<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxiTrajet;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function reserve(Request $request, $taxiTrajetId)
    {
        $passengerId = auth()->id();

        $taxiTrajet = TaxiTrajet::findOrFail($taxiTrajetId);

        $request->validate([
            'jour' => 'required|date',
            'number_of_seats' => 'required|integer|min:1|max:8',
        ]);

        $totalPrice = $taxiTrajet->taxi->prix * $request->number_of_seats;


        // Create a reservation record
        Reservation::create([
            'passenger_id' => $passengerId,
            'taxi_trajet_id' => $taxiTrajet->id,
            'jour' => $request->jour,
            'total_prix' => $totalPrice,
            'number_of_seats' => $request->number_of_seats,
            'rating' => null,
            'comment' => '',
        ]);
        return redirect()->route('search')->with('success', 'Reservation added successfully!');
    }
}
// $totalPrice = $taxiTrajet->taxi->prix * $request->number_of_seats;