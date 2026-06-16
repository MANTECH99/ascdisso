<?php

namespace App\Http\Controllers;

use App\Models\Matchs;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query = Matchs::visible()->orderedByDate();

        // Filtre par compétition
        if ($request->has('competition')) {
            $query->where('competition', $request->competition);
        }

        // Filtre par statut
        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par saison
        if ($request->has('saison')) {
            $query->where('saison', $request->saison);
        }

        $matchs = $query->paginate(15);
        
        // Statistiques
        $stats = $this->getStats();
        
        // Compétitions disponibles pour les filtres
        $competitions = Matchs::visible()->distinct()->pluck('competition');
        
        // Saisons disponibles
        $saisons = Matchs::visible()->distinct()->orderBy('saison', 'desc')->pluck('saison');

        return view('matchs.index', compact('matchs', 'stats', 'competitions', 'saisons'));
    }

    public function show($id)
    {
        $match = Matchs::visible()->findOrFail($id);
        return view('matchs.show', compact('match'));
    }

    private function getStats()
    {
        $matchsTermines = Matchs::visible()->termine()->get();
        
        $victoires = 0;
        $nuls = 0;
        $defaites = 0;
        $butsMarques = 0;
        $butsEncaisses = 0;

        foreach ($matchsTermines as $match) {
            if ($match->equipe_domicile === 'ASC Disso') {
                $butsMarques += $match->score_domicile;
                $butsEncaisses += $match->score_exterieur;
                
                if ($match->score_domicile > $match->score_exterieur) {
                    $victoires++;
                } elseif ($match->score_domicile < $match->score_exterieur) {
                    $defaites++;
                } else {
                    $nuls++;
                }
            } else {
                $butsMarques += $match->score_exterieur;
                $butsEncaisses += $match->score_domicile;
                
                if ($match->score_exterieur > $match->score_domicile) {
                    $victoires++;
                } elseif ($match->score_exterieur < $match->score_domicile) {
                    $defaites++;
                } else {
                    $nuls++;
                }
            }
        }

        return [
            'victoires' => $victoires,
            'nuls' => $nuls,
            'defaites' => $defaites,
            'buts_marques' => $butsMarques,
            'buts_encaisses' => $butsEncaisses,
            'total_matchs' => $matchsTermines->count(),
        ];
    }
}