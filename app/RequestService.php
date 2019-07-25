<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'main_service', 'sub_service', 'subs_service', 'project_status', 'project_timeline',
        'address_type', 'ownership', 'financing', 'description', 'address', 'country', 'state', 'city_name', 'zipcode'
    ];
}
