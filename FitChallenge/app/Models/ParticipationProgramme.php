<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipationProgramme extends Model
{
    protected $table = 'participation_programme';
    protected $primaryKey = 'id_participation';

    protected $fillable = ['date_debut', 'statut', 'id_programme', 'id_utilisateur'];

    protected $attributes = [
        'statut' => 'en_cours',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'id_programme');
    }
}
