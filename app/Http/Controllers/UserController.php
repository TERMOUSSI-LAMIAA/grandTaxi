<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getPassengers()
    {
        $passengers = User::where('type_user', 'passenger')->where('is_admin', 0)->get();
      
        return view("admin.gestionP",compact("passengers"));

    }
    public function getDrivers(){
        $drivers = User::where('type_user', 'driver')->get();
        return view("admin.gestionD",compact("drivers"));
    }
}
