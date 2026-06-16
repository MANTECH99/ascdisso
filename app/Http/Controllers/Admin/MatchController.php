<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matchs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;  // 👈 AJOUTEZ CETTE LIGNE

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $query = Matchs::query()->orderBy('date_match', 'desc');

        // Filtres
        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }

        if ($request->has('saison') && $request->saison != '') {
            $query->where('saison', $request->saison);
        }

        $matchs = $query->paginate(20);
        $saisons = Matchs::distinct()->orderBy('saison', 'desc')->pluck('saison');

        return view('admin.matchs.index', compact('matchs', 'saisons'));
    }

    public function create()
    {
        return view('admin.matchs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_match' => 'required|date',
            'competition' => 'required|string|max:255',
            'equipe_domicile' => 'required|string|max:255',
            'logo_domicile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 👈 Ajoutez
            'equipe_exterieur' => 'required|string|max:255',
            'logo_exterieur' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 👈 Ajoutez
            'score_domicile' => 'nullable|integer|min:0',
            'score_exterieur' => 'nullable|integer|min:0',
            'statut' => 'required|in:a_venir,en_cours,termine',
            'minute' => 'nullable|integer|min:0|max:120',
            'stade' => 'nullable|string|max:255',
            'buteurs_domicile' => 'nullable|string',  // 👈 String, pas json
            'buteurs_exterieur' => 'nullable|string',  // 👈 String, pas json
            'saison' => 'required|string|max:20',
            'is_visible' => 'boolean',
        ]);

            // Gestion des logos
    if ($request->hasFile('logo_domicile')) {
        $validated['logo_domicile'] = $request->file('logo_domicile')->store('equipes/logos', 'public');
    }
    
    if ($request->hasFile('logo_exterieur')) {
        $validated['logo_exterieur'] = $request->file('logo_exterieur')->store('equipes/logos', 'public');
    }

    // ✅ Gestion des buteurs
    if (!empty($request->buteurs_domicile)) {
        $buteursDom = explode("\n", $request->buteurs_domicile);
        $validated['buteurs_domicile'] = array_values(array_filter(array_map('trim', $buteursDom)));
    } else {
        $validated['buteurs_domicile'] = [];
    }

    if (!empty($request->buteurs_exterieur)) {
        $buteursExt = explode("\n", $request->buteurs_exterieur);
        $validated['buteurs_exterieur'] = array_values(array_filter(array_map('trim', $buteursExt)));
    } else {
        $validated['buteurs_exterieur'] = [];
    }

        $validated['is_visible'] = $request->has('is_visible');

        Matchs::create($validated);

        return redirect()->route('admin.matchs.index')
            ->with('success', 'Match ajouté avec succès !');
    }

    public function edit($id)
    {
        $match = Matchs::findOrFail($id);
        return view('admin.matchs.edit', compact('match'));
    }

    public function update(Request $request, $id)
    {
        $match = Matchs::findOrFail($id);

        $validated = $request->validate([
            'date_match' => 'required|date',
            'competition' => 'required|string|max:255',
            'equipe_domicile' => 'required|string|max:255',
            'logo_domicile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 👈 Ajoutez
            'equipe_exterieur' => 'required|string|max:255',
            'logo_exterieur' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 👈 Ajoutez
            'score_domicile' => 'nullable|integer|min:0',
            'score_exterieur' => 'nullable|integer|min:0',
            'statut' => 'required|in:a_venir,en_cours,termine',
            'minute' => 'nullable|integer|min:0|max:120',
            'stade' => 'nullable|string|max:255',
            'buteurs_domicile' => 'nullable|string',  // 👈 Changez de 'json' à 'string'
            'buteurs_exterieur' => 'nullable|string',  // 👈 Changez de 'json' à 'string'
            'saison' => 'required|string|max:20',
            'is_visible' => 'boolean',
        ]);

            // Gestion des logos
    if ($request->hasFile('logo_domicile')) {
        // Supprimer l'ancien logo
        if ($match->logo_domicile) {
            Storage::disk('public')->delete($match->logo_domicile);
        }
        $validated['logo_domicile'] = $request->file('logo_domicile')->store('equipes/logos', 'public');
    }
    
    if ($request->hasFile('logo_exterieur')) {
        // Supprimer l'ancien logo
        if ($match->logo_exterieur) {
            Storage::disk('public')->delete($match->logo_exterieur);
        }
        $validated['logo_exterieur'] = $request->file('logo_exterieur')->store('equipes/logos', 'public');
    }

    // ✅ Gestion des buteurs - Conversion du texte en tableau
    if (!empty($request->buteurs_domicile)) {
        $buteursDom = explode("\n", $request->buteurs_domicile);
        $validated['buteurs_domicile'] = array_values(array_filter(array_map('trim', $buteursDom)));
    } else {
        $validated['buteurs_domicile'] = [];
    }

    if (!empty($request->buteurs_exterieur)) {
        $buteursExt = explode("\n", $request->buteurs_exterieur);
        $validated['buteurs_exterieur'] = array_values(array_filter(array_map('trim', $buteursExt)));
    } else {
        $validated['buteurs_exterieur'] = [];
    }

        $validated['is_visible'] = $request->has('is_visible');

        $match->update($validated);

        return redirect()->route('admin.matchs.index')
            ->with('success', 'Match mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $match = Matchs::findOrFail($id);
        $match->delete();

        return redirect()->route('admin.matchs.index')
            ->with('success', 'Match supprimé avec succès !');
    }

    public function toggleVisibility($id)
    {
        $match = Matchs::findOrFail($id);
        $match->is_visible = !$match->is_visible;
        $match->save();

        return response()->json([
            'success' => true,
            'is_visible' => $match->is_visible
        ]);
    }
}