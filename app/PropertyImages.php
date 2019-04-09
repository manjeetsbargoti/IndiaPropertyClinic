<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImages extends Model
{
    //
    protected $fillable =[
        'image_name', 'image_size', 'property_id'
    ];
}
