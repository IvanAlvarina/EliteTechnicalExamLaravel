<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'id',
        'artist_id',
        'name',
        'year',
        'sales',
        'album_cover_path'
    ];
}
