<?php namespace Chxj1992\ApplesDataCenter\App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelocityItineraries extends Model
{
    public $timestamps = false;

    public $table = 'travelocity_itineraries';

    protected $casts = [
        'id' => 'int',
        'itinerary_id' => 'int',
        'duration' => 'int',
        'inside' => 'int',
        'oceanview' => 'int',
        'balcony' => 'int',
        'suite' => 'int',
        'is_lowest_price' => 'bool',
    ];


}