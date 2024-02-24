<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory,SoftDeletes;
  
    protected $fillable = [
        'passenger_id',
        'taxi_trajet_id',
        'jour',
        'total_prix',
        'number_of_seats',
        'rating',
        'comment',
    ];
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function taxiTrajet()
    {
        return $this->belongsTo(TaxiTrajet::class);
    }

   
}
