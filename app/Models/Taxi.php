<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    use HasFactory;

    protected $table = 'taxis';

    protected $fillable = [
        'immatriculation',
        'type_vehicule',
        'total_seats',
        'prix',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trajets()
    {
        return $this->belongsToMany(Trajet::class, 'taxi_trajet','trajet_id','taxi_id')
                    ->withPivot('hr_dep')
                    ->withTimestamps();
    }
 
    public function  taxiTrajets(){
        return $this->hasMany(TaxiTrajet::class,"taxi_id");
    }
      
//   protected static function boot()
//     {
//         parent::boot();

//         static::deleting(function ($taxi) {
//             // Detach associated trajets
//             $taxi->trajets()->detach();

//             // Find and delete associated taxi_trajet records
//             $taxi->taxiTrajets->each(function ($taxiTrajet) {
//                 // Delete associated reservations
//                 $taxiTrajet->reservations->each->delete();

//                 // Delete the taxiTrajet record
//                 $taxiTrajet->delete();
//             });
//         });
//     }
}
