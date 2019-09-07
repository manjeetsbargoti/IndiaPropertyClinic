<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneQuery extends Model
{
    //
    protected $fillable = [
        'name', 'usertype', 'phone', 'email', 'property_for', 'property_type', 
        'description', 'address', 'country', 'state', 'city', 'zipcode'
    ];
}
