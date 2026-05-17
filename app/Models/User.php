<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'password',
        'adresse',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

// App\Models\User.php
public function isAdmin()
{
    // Version plus robuste qui gère les différents cas
    return $this->is_admin == 1 || $this->is_admin === true;
    
    // Ou plus simplement :
    // return (bool) $this->is_admin;
}
}