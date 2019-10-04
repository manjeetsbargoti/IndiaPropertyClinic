<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpcQuery extends Model
{
    protected $fillable = [
        'name','email','phone','main_service','sub_service','subs_service','message','country','state','city'
    ];
}
