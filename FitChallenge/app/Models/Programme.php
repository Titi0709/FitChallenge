<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table = 'programme';
    protected $primaryKey = 'id_programme';

    protected $fillable = [
        'titre', 'description', 'type_exercice', 'objectif', 'duree', 'image', 'date_creation', 'prix','id_utilisateur','statut',
    ];

    public function videos()
    {
        return $this->hasOne(VideoProgramme::class, 'id_programme');
    }

    public function participations()
    {
        return $this->hasMany(ParticipationProgramme::class, 'id_programme');
    }

    public function achats()
    {
        return $this->hasMany(Achat::class, 'id_programme');
    }
        public function utilisateur()
    {
    return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
}
