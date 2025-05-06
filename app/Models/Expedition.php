<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    //
    protected $fillable = [
        'date',
        'single_occupancy',
        'double_occupancy',
        'destination_id',
    ];
}
