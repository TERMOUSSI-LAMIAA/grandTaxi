<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxiTrajet;

class TaxiTrajetController extends Controller
{
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
