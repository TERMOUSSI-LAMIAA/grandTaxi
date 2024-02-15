<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
class VilleController extends Controller
{
    public function get_villes()
    {
        $villes = Ville::all();
 
        return view('dashboard', compact('villes'));

    }

}
