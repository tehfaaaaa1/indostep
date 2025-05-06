<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Queue\Connectors\BeanstalkdConnector;

class ReservationGroup extends Model
{
    //
    protected $fillable = [
        'expedition_id',
        'accomodation_id'
    ];
    public function expedition() : BelongsTo {
        return $this->belongsTo(Expedition::class);
    }
    public function accomodation() : BelongsTo {
        return $this->belongsTo(Accomodation::class);
    }
    public function reservation() : HasMany {
        return $this->hasMany(Reservation::class, 'group_id');
    }
}
