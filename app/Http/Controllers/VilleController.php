<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;

class VilleController extends Controller
{
    public function get_villes()
    {
        $villes = Ville::all();

        return view('passenger.dashboard_p', compact('villes'));

    }
    public function testadmin()
    {
        return view("admin.dashboard_a");
    }
}
