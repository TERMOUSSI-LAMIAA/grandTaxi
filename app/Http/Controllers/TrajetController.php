<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxi;
use App\Models\TaxiTrajet;


class TrajetController extends Controller
{
    public function get_trajets(){
        $trajets = Trajet::all();
        
        return view('driver.dashboard_d', compact('trajets'));
    }
    public function addUserTrajets(Request $request)
    {
        $userId = Auth::id();
        // dd($userId);
        $trajets = Trajet::all();

        if ($request->isMethod('post')) {
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

            if (!$existingReversedTrajet) {
                $reversedTrajet->save();
            }

            $taxi = Taxi::where('user_id', $userId)->first();
            if ($taxi) {
                $taxi->prix = $price;
                $taxi->save();
            }

            // $trajet = Trajet::where('depart_id', $request->depart_id)
            //     ->where('destination_id', $request->destination_id)
            //     ->first();

            // if (!$trajet) {
            //     return redirect()->back()->with('error', 'Invalid departure or destination.');
            // }

            $taxiTrajet = new TaxiTrajet();
            $taxiTrajet->taxi_id = $taxi->id;
            $taxiTrajet->trajet_id = $selectedTrajet->id;
            $taxiTrajet->hr_dep = $request->hr_dep;
            $taxiTrajet->save();

            //todo reverse trajet add

            // return view('driver.dashboard_d', compact('trajets', 'selectedTrajet', 'reversedTrajet'));
            return view('driver.dashboard_d', compact('trajets', 'selectedTrajet', 'reversedTrajet'));
        }

        return view('dashboard', compact('trajets'));
    }
    public function searchTaxiTrajet(Request $request)
    {
        $departCity = $request->input('vil_dep');
        $arriveeCity = $request->input('vil_arv');


        $results = TaxiTrajet::whereHas('trajet', function ($query) use ($departCity, $arriveeCity) {
            $query->where('depart_id', $departCity)
                  ->where('destination_id', $arriveeCity);
        })->get();
        return view('passenger.trajets', compact('results'));
    }

}
