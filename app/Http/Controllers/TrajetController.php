<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function get_trajets(Request $request)
    {
        $trajets = Trajet::all();

        if ($request->isMethod('post')) {
            $selectedTrajetId = $request->input('first_trajet_select');

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

            return view('driver.dashboard_d', compact('trajets', 'selectedTrajet', 'reversedTrajet'));
        }

        return view('driver.dashboard_d', compact('trajets'));
    }



}
