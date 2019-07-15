<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    // Add Amenities to the Database
    protected $fillable = [
        'name','amenity_code', 'description', 'status'
    ];
}
