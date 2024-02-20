<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxi;
use App\Models\TaxiTrajet;
use Carbon\Carbon;

class TrajetController extends Controller
{
    public function get_trajets()
    {
        $trajets = Trajet::all();

        return view('driver.dashboard_d', compact('trajets'));
    }
    public function addUserTrajets(Request $request)
    {//!check if driver has already two taxi_trajet then update them
        $userId = Auth::id();
        $trajets = Trajet::all();


        $selectedTrajetId = $request->input('first_trajet_select');
        $price = $request->input('price');
        $hr_dep = $request->input('hr_dep');
        $selectedTrajet = Trajet::find($selectedTrajetId);

        $reversedTrajet = new Trajet();
        $reversedTrajet->depart_id = $selectedTrajet->destination_id;
        $reversedTrajet->destination_id = $selectedTrajet->depart_id;
        $reversedTrajet->duree = $selectedTrajet->duree;

        $existingReversedTrajet = Trajet::where('depart_id', $reversedTrajet->depart_id)
            ->where('destination_id', $reversedTrajet->destination_id)
            ->first();
        //  dd taxi price
        $taxi = Taxi::where('user_id', $userId)->first();
        if ($taxi) {
            $taxi->prix = $price;
            $taxi->save();
        }
        // add 1st taxi road
        $taxiTrajet = new TaxiTrajet();
        $taxiTrajet->taxi_id = $taxi->id;
        $taxiTrajet->trajet_id = $selectedTrajet->id;
        $taxiTrajet->hr_dep = $request->hr_dep;
        $taxiTrajet->save();
        // add 2nd taxi road

        $taxiTrajet2 = new TaxiTrajet();
        $taxiTrajet2->taxi_id = $taxi->id;

        if (!$existingReversedTrajet) {
            $reversedTrajet->save();
            $taxiTrajet2->trajet_id = $reversedTrajet->id;
        }
        else{
            $taxiTrajet2->trajet_id = $existingReversedTrajet->id;
        }
        list($hours, $minutes) = explode(':', $selectedTrajet->duree);
        $totalMinutesToAdd = ($hours * 60) + $minutes + (3 * 60); //add 3 hours
        $newHrDep = Carbon::parse($hr_dep)->addMinutes($totalMinutesToAdd)->format('H:i');

        $taxiTrajet2->hr_dep =$newHrDep;
        $taxiTrajet2->save();

        return view('driver.dashboard_d', compact('selectedTrajet', 'reversedTrajet', 'trajets'));

    }


}
