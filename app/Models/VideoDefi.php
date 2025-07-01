<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class VideoDefi extends Model
{
    use HasFactory;


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
