<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeProduct extends Model
{
    protected $fillable = [
        'commande_id',
        'product_id',
        'quantite',
        'prix_unitaire',
        'sous_total',
    ];

    protected $casts = [
        'prix_unitaire' => 'decimal:2',
        'sous_total' => 'decimal:2',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}