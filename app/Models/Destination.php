<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Destination extends Model
{
    //
    protected $fillable =[
        'destination',
        'island_id',
        'trip_type_id',
        'address',
        'overview',
        'image',
    ];
    public function island() : BelongsTo {
            return $this->BelongsTo(Island::class, 'island_id');
    }
    public function type() : BelongsTo {
        return $this->BelongsTo(TripType::class, 'trip_type_id');
    }
    public function expedition() : HasMany {
        return $this->hasMany(Expedition::class, 'destination_id' );
    }
    public function accomodation() : HasMany {
        return $this->hasMany(DestinationAccomodation::class, 'destination_id' );
    }
    public function expert() : HasMany {
        return $this->hasMany(DestinationExpert::class, 'destination_id' );
    }
    public function scopeFilter(Builder $query, array $filters) {
        $query->when($filters['island']??false, fn($query, $island) => 
            $query->whereHas('island', fn($query)=> $query->whereIn('name', $island))
        );
        $query->when($filters['type']??false, fn($query, $type) => 
            $query->whereHas('type', fn($query)=> $query->whereIn('name', $type))
        );
        $query->when($filters['month']??false, fn($query, $month) => 
            $query->whereHas('expedition', fn($query)=> $query->whereIn('date', $month))
        );
    }
}
