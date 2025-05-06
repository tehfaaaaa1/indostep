<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    //
    protected $fillable =[
        'name',
        'description',
        'address',
        'image',
    ];
}
