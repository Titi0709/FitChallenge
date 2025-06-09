<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // au lieu de Model
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

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

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    // 👇 C’est ici qu’on précise à Laravel où est le mot de passe
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // relations
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
    public function defisCrees()
{
    return $this->hasMany(Defi::class, 'id_utilisateur');
}
    public function programmesCrees()
    {
        return $this->hasMany(Programme::class, 'id_utilisateur');
    }

}
