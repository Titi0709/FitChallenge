<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipationDefi extends Model
{
    protected $table = 'participation_defi';
    protected $primaryKey = 'id_participation';

    protected $fillable = [
        'date_debut',
        'statut',
        'id_defi',
        'id_utilisateur',
    ];

    protected $attributes = [
        'statut' => 'en_cours', 
    ];
    
    public function defi()
    {
        return $this->belongsTo(Defi::class, 'id_defi');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
}
