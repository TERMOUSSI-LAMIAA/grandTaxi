<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo_profil',
        'tel',
        'description',
        'type_paiement',
        'type_user',
        'statut',

    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function taxi()
    {
        return $this->hasOne(Taxi::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'passenger_id');
    }
    //!!!!!!!!!!!!!!!!!!!!!!!!!!
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::deleting(function ($user) {
    //         if ($user->type_user === 'driver') {
    //             $user->taxi->taxiTrajets()->get()->each(function ($taxi_trajet) {
    //             // Soft delete related reservations records
    //             // $taxi_trajet->reservations()->delete();

    //             // Soft delete the taxi_trajet record
    //             $taxi_trajet->delete();
    //         });
    //             $user->taxi()->delete();
    //             $user->delete();
                // if ($user->taxi) {           
                //        // Delete associated reservations for all taxi_trajet records
                // $user->taxi->taxiTrajets->each(function ($taxiTrajet) {
                //     $taxiTrajet->reservations()->delete();
                // });
    
                // $user->taxi->taxiTrajets->each(function ($taxiTrajet) {
                //     $taxiTrajet->delete();
                // });

                // // Delete the taxi
                // $user->taxi->delete();
                // }
            // }
            // elseif($user->type_user === 'passenger'){
            //     $user->reservations->each->delete();
            // }
        // });

    // }
}
// if( $user->taxi){
//     $user->taxi->delete();
// }
// elseif($user->reservations){
//     $user->reservations->each->delete();
// }