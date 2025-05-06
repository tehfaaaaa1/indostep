<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationExpert extends Model
{
    //
    protected $fillablee= [
        'destination_id',
        'expert_id',
    ];
    public function destination() : BelongsTo {
        return $this->belongsTo(Destination::class, 'destination_id' );
    }
    public function expert() : BelongsTo {
        return $this->belongsTo(Expert::class, 'expert_id' );
    }
}
