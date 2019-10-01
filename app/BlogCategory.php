<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'name', 'url', 'description', 'parent_category', 'status', 'category_image'
    ];
}
