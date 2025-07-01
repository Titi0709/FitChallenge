<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $table = 'achat';
    protected $primaryKey = 'id_achat';

    protected $fillable = ['date_achat', 'id_programme', 'id_utilisateur'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur');
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'id_programme');
    }
}
