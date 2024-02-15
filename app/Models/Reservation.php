<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function taxiTrajet()
    {
        return $this->belongsTo(TaxiTrajet::class);
    }
}
