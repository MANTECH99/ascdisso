<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Matchs extends Model
{
    use HasFactory;

    protected $table = 'matchs';

    protected $fillable = [
        'date_match',
        'competition',
        'equipe_domicile',
        'logo_domicile',        // 👈 Ajoutez
        'equipe_exterieur',
        'logo_exterieur',       // 👈 Ajoutez
        'score_domicile',
        'score_exterieur',
        'statut',
        'minute',
        'stade',
        'buteurs_domicile',
        'buteurs_exterieur',
        'saison',
        'is_visible',
    ];

    protected $casts = [
        'date_match' => 'datetime',
        'score_domicile' => 'integer',
        'score_exterieur' => 'integer',
        'buteurs_domicile' => 'array',
        'buteurs_exterieur' => 'array',
        'is_visible' => 'boolean',
    ];

    // Scopes
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeAVenir($query)
    {
        return $query->where('statut', 'a_venir')->where('date_match', '>=', now());
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeTermine($query)
    {
        return $query->where('statut', 'termine');
    }

    public function scopeSaison($query, $saison)
    {
        return $query->where('saison', $saison);
    }

    public function scopeOrderedByDate($query)
    {
        return $query->orderBy('date_match', 'desc');
    }

// Modifier l'accesseur getDateFormateeAttribute
public function getDateFormateeAttribute()
{
    if (!$this->date_match) {
        return 'Date à déterminer';
    }
    return $this->date_match->isoFormat('D MMMM YYYY');
}

// Modifier l'accesseur getHeureAttribute
public function getHeureAttribute()
{
    if (!$this->date_match) {
        return '--:--';
    }
    return $this->date_match->format('H:i');
}

    public function getScoreAttribute()
    {
        if ($this->score_domicile === null || $this->score_exterieur === null) {
            return null;
        }
        return $this->score_domicile . ' - ' . $this->score_exterieur;
    }

    public function getResultatAttribute()
    {
        if ($this->score_domicile === null || $this->score_exterieur === null) {
            return null;
        }

        if ($this->score_domicile > $this->score_exterieur) {
            return 'victoire';
        } elseif ($this->score_domicile < $this->score_exterieur) {
            return 'defaite';
        } else {
            return 'nul';
        }
    }

    public function getCouleurStatutAttribute()
    {
        return match($this->statut) {
            'a_venir' => 'blue',
            'en_cours' => 'red',
            'termine' => 'gray',
            default => 'gray',
        };
    }

    public function getLabelStatutAttribute()
    {
        return match($this->statut) {
            'a_venir' => 'À venir',
            'en_cours' => 'En direct',
            'termine' => 'Terminé',
            default => 'Inconnu',
        };
    }

    // Ajoutez ces accesseurs pour les logos
public function getLogoDomicileUrlAttribute()
{
    if ($this->logo_domicile) {
        // Si c'est une URL externe
        if (filter_var($this->logo_domicile, FILTER_VALIDATE_URL)) {
            return $this->logo_domicile;
        }
        // Si c'est un fichier local
        return asset('storage/' . $this->logo_domicile);
    }
    
    // Logo par défaut si ASC Disso
    if ($this->equipe_domicile === 'ASC Disso') {
        return asset('images/logo.png');
    }
    
    return null;
}

public function getLogoExterieurUrlAttribute()
{
    if ($this->logo_exterieur) {
        if (filter_var($this->logo_exterieur, FILTER_VALIDATE_URL)) {
            return $this->logo_exterieur;
        }
        return asset('storage/' . $this->logo_exterieur);
    }
    
    if ($this->equipe_exterieur === 'ASC Disso') {
        return asset('images/logo.png');
    }
    
    return null;
}

// Dans app/Models/Matchs.php

public function scopeSansDate($query)
{
    return $query->whereNull('date_match');
}

public function scopeAvecDate($query)
{
    return $query->whereNotNull('date_match');
}

}