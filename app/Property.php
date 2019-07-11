<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Property extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'property_url' => [
                'source' => 'property_name'
            ]
        ];
    }

    protected $fillable = [
        'property_name', 'property_url', 'property_type_id', 'property_code', 'property_price', 'booking_price', 'description', 'featured', 'commercial',
        'map_pass', 'open_sides', 'parea', 'widthroad', 'furnish_type', 'floorno', 'total_floors', 'apple_trees', 'parea', 'pfacing', 'transaction_type', 'construction_status',
        'bedrooms', 'bathrooms', 'balconies', 'p_washrooms', 'cafeteria', 'road_facing', 'c_shop', 'wall_made', 'p_showroom', 'property_age', 'plotno',
        'address1', 'address2', 'locality', 'country', 'state', 'city', 'zipcode', 'add_by', 'builder', 'agent', 'service_id'
    ];

    
}
