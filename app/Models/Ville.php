<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;
    protected $fillable = ['ville'];
    public function departures()
    {
        return $this->hasMany(Trajet::class, 'depart_id');
    }

    public function destinations()
    {
        return $this->hasMany(Trajet::class, 'destination_id');
    }
}
