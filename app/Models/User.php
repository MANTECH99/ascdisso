<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PragmaRX\Google2FALaravel\Support\Authenticator;

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
        'is_super_admin',
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

public function isSuperAdmin()
{
    return $this->is_super_admin == 1 || $this->is_super_admin === true;
}





public function enable2FA()
{
    $this->google2fa_secret = app('pragmarx.google2fa')->generateSecretKey();
    $this->google2fa_enabled = true;
    $this->save();
}

public function disable2FA()
{
    $this->google2fa_secret = null;
    $this->google2fa_enabled = false;
    $this->save();
}

public function get2FAQRCode()
{
    if (!$this->google2fa_secret) return null;
    
    return app('pragmarx.google2fa')->getQRCodeInline(
        'ASC Disso',
        $this->email,
        $this->google2fa_secret
    );
}
}