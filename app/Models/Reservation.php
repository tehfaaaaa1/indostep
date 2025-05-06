<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'country',
        'zip_code',
        'group_id',
        'name',
    ];
    public function group() : BelongsTo {
        return $this->belongsTo(ReservationGroup::class, 'group_id');
    }
}
