<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class artist extends Model
{
    protected $fillable = [
        'id',
        'code',
        'name'
    ];

    public function albums()
    {
        return $this->hasMany(Album::class, 'artist_id', 'id');
    }
}
