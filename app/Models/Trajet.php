<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;
    protected $fillable = ['depart_id', 'destination_id', 'duree'];
    public function taxis()
    {
        return $this->belongsToMany(Taxi::class);
    }
    
    public function departure()
    {
        return $this->belongsTo(Ville::class, 'depart_id');
    }

    public function destination()
    {
        return $this->belongsTo(Ville::class, 'destination_id');
    }
}
