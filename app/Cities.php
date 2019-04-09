<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    //
    protected $fillable =[
        'id', 'name', 'state_id', 'country_id'
    ];
}
