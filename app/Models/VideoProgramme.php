<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProgramme extends Model
{
    protected $table = 'video_programme';
    protected $primaryKey = 'id_video';

    protected $fillable = ['titre', 'url', 'id_programme'];

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'id_programme');
    }
}
 