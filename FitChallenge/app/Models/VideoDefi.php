<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoDefi extends Model
{
    protected $table = 'video_defi';
    protected $primaryKey = 'id_video';

    protected $fillable = [
        'titre',
        'url',
        'id_defi',
    ];

    public function defi()
    {
        return $this->belongsTo(Defi::class, 'id_defi');
    }
}
