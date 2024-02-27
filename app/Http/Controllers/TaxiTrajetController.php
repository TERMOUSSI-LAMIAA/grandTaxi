<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxiTrajet;
use Illuminate\Support\Facades\DB;  

class TaxiTrajetController extends Controller
{
    public function searchTaxiTrajet(Request $request)
    {
        $departCity = $request->input('vil_dep');
        $arriveeCity = $request->input('vil_arv');

        $order = $request->input('order');

        $results = TaxiTrajet::whereHas('trajet', function ($query) use ($departCity, $arriveeCity) {
            $query->where('depart_id', $departCity)
                ->where('destination_id', $arriveeCity);
        });
         if ($order === 'price') {
        $results = $results
            ->join('taxis', 'taxis.id', '=', 'taxi_trajet.taxi_id')
            ->orderBy('taxis.prix', 'asc');
        } elseif ($order === 'time') {
            $results = $results->orderBy('taxi_trajet.hr_dep', 'asc');
        }

        $results = $results->get();
    
        return view('passenger.trajets', compact('results'));
    }
}
