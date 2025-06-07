<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badge';
    protected $primaryKey = 'id_badge';

    protected $fillable = ['nom', 'description', 'image_url'];

    public function obtentions()
    {
        return $this->hasMany(BadgeObtention::class, 'id_badge');
    }
}
