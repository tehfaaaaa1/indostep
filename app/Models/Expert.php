<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    //
    protected $fillable=[
        'name',
        'skill',
        'biography',
        'image'
    ];
}
