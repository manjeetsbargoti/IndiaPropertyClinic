<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'business_name','business_type','owner_name','owner_phone','business_description','experience',
        'business_email','business_phone','business_website','user_id','status','country','state','city',
        'locality','zipcode'
    ];
}
