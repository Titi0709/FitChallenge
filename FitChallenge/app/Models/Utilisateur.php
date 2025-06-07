<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';
    public $timestamps = true;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
        'date_inscription',
    ];

    protected $attributes = [
    'role' => 'utilisateur',
    ];

    
 public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'id_utilisateur_envoyeur');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'id_utilisateur_receveur');
    }

    public function badgeObtentions()
    {
        return $this->hasMany(BadgeObtention::class, 'id_utilisateur');
    }

    public function participationsDefis()
    {
        return $this->hasMany(ParticipationDefi::class, 'id_utilisateur');
    }

    public function participationsProgrammes()
    {
        return $this->hasMany(ParticipationProgramme::class, 'id_utilisateur');
    }

    public function achats()
    {
        return $this->hasMany(Achat::class, 'id_utilisateur');
    }
}