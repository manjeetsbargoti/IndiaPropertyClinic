<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function createSlug($str){

        $delimiter = '-';
        $categories = Category::whereRaw('LOWER(`title`) = ? ',trim(strtolower($str)))->withTrashed()->count();
        if($categories >= 1){
            $categories = $categories + 1;
            $slug = str_slug(trim(strtolower($str))).$delimiter.$categories;
        }else{
            $slug = str_slug(trim(strtolower($str)));
        }

        return $slug;
    }

}