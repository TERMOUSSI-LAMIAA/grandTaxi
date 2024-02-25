<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxiTrajet;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


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
        $input_number=$request->number_of_seats;
      $input_date=$request->jour;

        $total_seats=$taxiTrajet->taxi->total_seats;
        $sum_seats=$taxiTrajet->reservations->where('jour', $input_date)->sum('number_of_seats');
        if($total_seats<$sum_seats+$input_number){
            return redirect()->back()->with('error', 'Not enough available seats.');    
        }
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
    static public function getReservation()
    {
        $currentDate = Carbon::now()->toDateString();
        $userId = Auth::id();

        // $newReservations = Reservation::with(['passenger', 'taxiTrajet.trajet', 'taxiTrajet.taxi'])
        //     ->where('jour', '>=', $currentDate)
        //     ->whereRaw("TIMESTAMP(CONCAT(jour, ' ', taxi_trajet.hr_dep)) + INTERVAL TIME_TO_SEC(trajets.duree) SECOND >= NOW()")
        //     ->get();
        // dd($newReservations);
        // $newReservations = Reservation::with(['passenger', 'taxiTrajet.trajet', 'taxiTrajet.taxi'])
        //     ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
        //     ->join('trajets', 'taxi_trajet.trajet_id', '=', 'trajets.id')
        //     ->where('reservations.jour', '>=', $currentDate)
        //     ->whereRaw("TIMESTAMP(CONCAT(reservations.jour, ' ', taxi_trajet.hr_dep)) + INTERVAL TIME_TO_SEC(trajets.duree) SECOND >= NOW()")
        //     ->get();
        $newReservations = Reservation::with(['passenger', 'taxiTrajet.trajet', 'taxiTrajet.taxi'])
            ->select('reservations.*')//*reservation id confused
            ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
            ->join('trajets', 'taxi_trajet.trajet_id', '=', 'trajets.id')
            ->where('reservations.jour', '>=', $currentDate)
            ->whereRaw("TIMESTAMP(CONCAT(reservations.jour, ' ', taxi_trajet.hr_dep)) + INTERVAL TIME_TO_SEC(trajets.duree) SECOND >= NOW()")
            ->where('passenger_id', $userId)
            ->distinct() //* distinct->reservation id confused
            ->get();

        $oldReservations = Reservation::with(['passenger', 'taxiTrajet.trajet', 'taxiTrajet.taxi'])
            ->select('reservations.*') // Select only columns from reservations table
            ->join('taxi_trajet', 'reservations.taxi_trajet_id', '=', 'taxi_trajet.id')
            ->join('trajets', 'taxi_trajet.trajet_id', '=', 'trajets.id')
            ->where('reservations.jour', '<=', $currentDate)
            ->whereRaw("TIMESTAMP(CONCAT(reservations.jour, ' ', taxi_trajet.hr_dep)) + INTERVAL TIME_TO_SEC(trajets.duree) SECOND < NOW()")
            ->where('passenger_id', $userId)
            ->distinct() // Ensure distinct reservation records
            ->get();

            return [
                'newReservations' => $newReservations,
                'oldReservations' => $oldReservations,
            ];
    }
    public function getReservations(){
        $reservationsData = $this->getReservation();

        $newReservations = $reservationsData['newReservations'];
        $oldReservations = $reservationsData['oldReservations'];
    
        return view('passenger.reservations', compact('newReservations', 'oldReservations'));
    }
    public function cancelReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }
    public function evaluate(Request $request, $reservationId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $reservation = Reservation::findOrFail($reservationId);

        if ($reservation->rating === null && ($reservation->comment === null || $reservation->comment === '')) {
            $reservation->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect()->route('mesReservations')->with('success', 'Reservation evaluated successfully');
        } else {
            return redirect()->route('mesReservations')->with('error', 'Reservation has already been evaluated');
        }
    }
    public function deleteReservation(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        $reservation->delete();

        return redirect()->route('gestReservationsAdmin')->with('success', 'reservation deleted successfully.');
    }
}
