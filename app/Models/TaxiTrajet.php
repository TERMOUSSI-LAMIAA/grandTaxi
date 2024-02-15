<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiTrajet extends Model
{
    use HasFactory;
    protected $table = 'taxi_trajet'; 
    public function taxi()
    {
        return $this->belongsTo(Taxi::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'taxi_trajet_id');
    }
}