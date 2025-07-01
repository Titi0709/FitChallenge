<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeObtention extends Model
{
    protected $table = 'badge_obtention';
    protected $primaryKey = 'id_badge_obtention';

    protected $fillable = ['date_obtention', 'id_utilisateur', 'id_badge'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class, 'id_badge');
    }
}
