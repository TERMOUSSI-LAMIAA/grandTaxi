<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Trajet extends Model
{
    use HasFactory,SoftDeletes;
    //!added this
    protected $table = 'trajets';
    protected $fillable = ['depart_id', 'destination_id', 'duree'];
    public function taxis()
    {
        return $this->belongsToMany(Taxi::class, 'taxi_trajet')
            ->withPivot('hr_dep')
            ->withTimestamps();
    }
    public function departure()
    {
        return $this->belongsTo(Ville::class, 'depart_id');
    }

    public function destination()
    {
        return $this->belongsTo(Ville::class, 'destination_id');
    }
    // public function reservations()
    // {
    //     return $this->hasManyThrough(Reservation::class, TaxiTrajet::class);
    // }
}
