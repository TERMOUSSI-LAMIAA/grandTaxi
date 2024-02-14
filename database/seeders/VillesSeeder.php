<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// ---
use App\Models\Ville;
class VillesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fes',
            'Tangier',
            'Agadir',
            'Meknes',
            'Oujda',
            'Kenitra',
            'Tetouan',
            'Safi',
            'Sale',
            'Nador',
            'Al Hoceima',
            'Beni Mellal',
            'Khouribga',
            'Taza',
            'Settat',
            'Inezgane',
            'Larache'
        ];

        foreach ($villes as $ville) {
            Ville::create(['ville' => $ville]);
        }
    }
}
