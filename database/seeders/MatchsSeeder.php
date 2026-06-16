<?php

namespace Database\Seeders;

use App\Models\Matchs;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MatchsSeeder extends Seeder
{
    public function run()
    {
        $matchs = [
            [
                'date_match' => Carbon::create(2026, 6, 20, 17, 0, 0),
                'competition' => 'Ligue 1 Sénégal',
                'equipe_domicile' => 'ASC Disso',
        'logo_domicile' => null, // Sera remplacé par le logo ASC Disso par défaut
        'equipe_exterieur' => 'Diambars FC',
        'logo_exterieur' => null,
                'score_domicile' => 2,
                'score_exterieur' => 1,
                'statut' => 'termine',
                'buteurs_domicile' => ['M. Diop 23\'', 'I. Sarr 67\''], // 👈 Enlevez json_encode()
                'buteurs_exterieur' => ['A. Ndiaye 45\''], // 👈 Enlevez json_encode()
                'stade' => 'Stade de Mboro',
                'saison' => '2025-2026',
            ],
            [
                'date_match' => Carbon::create(2026, 6, 15, 17, 0, 0),
                'competition' => 'Ligue 1 Sénégal',
                'equipe_domicile' => 'ASC Disso',
                        'logo_domicile' => null, // Sera remplacé par le logo ASC Disso par défaut
                'equipe_exterieur' => 'Génération Foot',
                        'logo_exterieur' => null,
                'score_domicile' => 0,
                'score_exterieur' => 0,
                'statut' => 'en_cours',
                'minute' => 67,
                'stade' => 'Stade de Mboro',
                'saison' => '2025-2026',
                'buteurs_domicile' => [], // 👈 Ajoutez un tableau vide
                'buteurs_exterieur' => [], // 👈 Ajoutez un tableau vide
            ],
            [
                'date_match' => Carbon::create(2026, 6, 25, 18, 0, 0),
                'competition' => 'Coupe du Sénégal',
                'equipe_domicile' => 'ASC Disso',
                        'logo_domicile' => null, // Sera remplacé par le logo ASC Disso par défaut
                'equipe_exterieur' => 'Jaraaf',
                        'logo_exterieur' => null,
                'statut' => 'a_venir',
                'stade' => 'Stade Léopold Sédar Senghor',
                'saison' => '2025-2026',
                'buteurs_domicile' => [], // 👈 Ajoutez un tableau vide
                'buteurs_exterieur' => [], // 👈 Ajoutez un tableau vide
            ],
        ];

        foreach ($matchs as $match) {
            Matchs::create($match);
        }
    }
}