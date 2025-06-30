<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Defi extends Model
{
    use HasFactory;


    protected $table = 'defi';
    protected $primaryKey = 'id_defi';

    protected $fillable = [
        'titre',
        'description',
        'type_exercice',
        'objectif',
        'duree',
        'image',
        'date_creation',
        'prix',
        'id_utilisateur',
        'statut',
    ];

    public function participations()
    {
        return $this->hasMany(ParticipationDefi::class, 'id_defi');
    }

    public function video()
    {
        return $this->hasOne(VideoDefi::class, 'id_defi');
    }
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }
}
