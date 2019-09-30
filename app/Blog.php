<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Insert data to table
    protected $fillable = [
        'title','url','content','post_type','template','category','status','add_by',
        'country','state','city','feature_image'
    ];
}
