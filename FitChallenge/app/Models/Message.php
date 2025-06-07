<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'id_message';

    protected $fillable = ['contenu', 'date_envoi', 'id_utilisateur_envoyeur', 'id_utilisateur_receveur'];

    public function envoyeur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_envoyeur');
    }

    public function receveur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur_receveur');
    }
}
