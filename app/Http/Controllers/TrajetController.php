<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Taxi;
use App\Models\TaxiTrajet;

class TrajetController extends Controller
{
    public function get_trajets(Request $request)
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

            // $taxiTrajet = TaxiTrajet::create([
            //     'taxi_id' => $taxi->id,
            //     'trajet_id' => $trajet->id,
            //     'hr_dep' => $request->hr_dep,
            // ]);

            // return view('driver.dashboard_d', compact('trajets', 'selectedTrajet', 'reversedTrajet'));
             return view('dashboard', compact('trajets', 'selectedTrajet', 'reversedTrajet'));
        }

        return view('dashboard', compact('trajets'));
    }
    public function updateTaxiPriceAndAddTrajetRecord(Request $request)
    {
        $taxi = Taxi::where('user_id', Auth::id())->first();

        if (!$taxi) {
            $taxi = new Taxi();
            $taxi->user_id = Auth::id();
        }

        $taxi->price = $request->price;
        $taxi->save();

        $trajet = Trajet::where('depart_id', $request->depart_id)
            ->where('destination_id', $request->destination_id)
            ->first();

        if (!$trajet) {
            return redirect()->back()->with('error', 'Invalid departure or destination.');
        }

        $taxiTrajet = new TaxiTrajet();
        $taxiTrajet->taxi_id = $taxi->id;
        $taxiTrajet->trajet_id = $trajet->id;
        $taxiTrajet->hr_dep = $request->hr_dep;
        $taxiTrajet->save();

        return redirect()->back()->with('success', 'Taxi price updated and trajet record added.');
    }


}
