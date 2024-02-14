<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// --
use App\Models\Trajet;
use App\Models\Ville;

class TrajetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $randomDuration = rand(1800, 36000);
        $formattedDuration = gmdate('H:i:s', $randomDuration);
        Trajet::create([
            'depart_id' => 11,
            'destination_id' => 20,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 11,
            'destination_id' => 3,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 14,
            'destination_id' => 12,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 12,
            'destination_id' => 10,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 10,
            'destination_id' => 8,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 1,
            'destination_id' =>8,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' =>17,
            'destination_id' => 20,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 20,
            'destination_id' => 5,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' =>5,
            'destination_id' => 15,
            'duree' => $formattedDuration
        ]);
        Trajet::create([
            'depart_id' => 3,
            'destination_id' => 19,
            'duree' => $formattedDuration
        ]);



    }
}
