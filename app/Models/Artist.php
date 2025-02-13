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
}
