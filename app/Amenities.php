<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    // Add Amenities to the Database
    protected $fillable = [
        'property_id', 'gym', 'club_house', 'play_area', 'water_supply', 'geyser', 'visitor_arking', 'garden', 'waste_disposal', 'power_backup', 'swimming_pool', 'water_storage'
    ];
}
