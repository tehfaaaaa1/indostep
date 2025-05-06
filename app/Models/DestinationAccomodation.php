<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationAccomodation extends Model
{
    //
    protected $fillable = [
        'destination_id',
        'accomodation_id'
    ];
    public function destination() : BelongsTo {
        return $this->belongsTo(Destination::class, 'destination_id' );
    }
    public function accomodation() : BelongsTo {
        return $this->belongsTo(Accomodation::class, 'accomodation_id' );
    }
}
