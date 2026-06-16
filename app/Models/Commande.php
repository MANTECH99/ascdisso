<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'user_id',
        'nom_complet',
        'adresse',
        'telephone',
        'mode_paiement',
        'mode_livraison',
        'statut',
        'statut_paiement',
        'sous_total',
            'frais',        // ← AJOUTER
        'total',
        'cart_token',
    ];

    protected $casts = [
        'sous_total' => 'decimal:2',
            'frais' => 'decimal:2',  // ← AJOUTER
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commandeProducts()
    {
        return $this->hasMany(CommandeProduct::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getQuantiteTotaleAttribute()
    {
        return $this->commandeProducts()->sum('quantite');
    }

    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_attente' => 'bg-yellow-100 text-yellow-800',
            'validee' => 'bg-green-100 text-green-800',
            'livree' => 'bg-blue-100 text-blue-800',
            'annulee' => 'bg-red-100 text-red-800',
        ];
        return $badges[$this->statut] ?? 'bg-gray-100 text-gray-800';
    }

public function getStatutPaiementBadgeAttribute()
{
    $badges = [
        'non_paye' => 'bg-gray-100 text-gray-800',
        'paye' => 'bg-green-100 text-green-800',
    ];
    return $badges[$this->statut_paiement] ?? 'bg-gray-100 text-gray-800';
}

    public function getModePaiementLabelAttribute()
    {
        $labels = [
            'livraison' => 'Paiement à la livraison',
            'wave' => 'Wave',
            'orange_money' => 'Orange Money',
        ];
        return $labels[$this->mode_paiement] ?? $this->mode_paiement;
    }
}