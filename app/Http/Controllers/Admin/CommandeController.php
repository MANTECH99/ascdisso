<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Notification;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'en_attente');
        
        $commandes = Commande::with('user')
            ->when($status, function ($query, $status) {
                return $query->where('statut', $status);
            })
            ->latest()
            ->paginate(20);

        return view('admin.commandes.index', compact('commandes', 'status'));
    }

    public function show($id)
    {
        $commande = Commande::with(['commandeProducts.product', 'user'])->findOrFail($id);
        return view('admin.commandes.show', compact('commande'));
    }

    public function valider($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => 'validee']);

        // Envoyer notification à l'utilisateur (s'il est connecté)
        if ($commande->user_id) {
            Notification::create([
                'user_id' => $commande->user_id,
                'commande_id' => $commande->id,
                'message' => '✅ Votre commande #' . $commande->id . ' a été validée ! Montant : ' . number_format($commande->total, 0) . ' FCFA',
            ]);
        }

        return redirect()->route('admin.commandes.index')->with('success', 'Commande #' . $commande->id . ' validée avec succès !');
    }

    public function livrer($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => 'livree']);

        if ($commande->user_id) {
            Notification::create([
                'user_id' => $commande->user_id,
                'commande_id' => $commande->id,
                'message' => '🚚 Votre commande #' . $commande->id . ' est en cours de livraison !',
            ]);
        }

        return redirect()->route('admin.commandes.index')->with('success', 'Commande #' . $commande->id . ' marquée comme livrée !');
    }

    public function annuler($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->update(['statut' => 'annulee']);

        if ($commande->user_id) {
            Notification::create([
                'user_id' => $commande->user_id,
                'commande_id' => $commande->id,
                'message' => '❌ Votre commande #' . $commande->id . ' a été annulée. Contactez le service client.',
            ]);
        }

        return redirect()->route('admin.commandes.index')->with('success', 'Commande #' . $commande->id . ' annulée.');
    }
}