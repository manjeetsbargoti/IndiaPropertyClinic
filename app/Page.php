<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'url', 'content', 'status', 'page_type', 'template', 'add_by', 'image', 'country', 'state', 'city', 'property_for'
    ];
}
