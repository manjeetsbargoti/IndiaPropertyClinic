<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class PpcPage extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'url' => [
                'source' => 'title'
            ]
        ];
    }

    // Insert data into database
    protected $fillable = [
        'title','url','ppc_type','email','phone','main_service','sub_service','subs_service','banner_content','description',
        'country','state','city','status','banner_image','template_design','meta_title','meta_description','meta_keywords',
        'index_status'
    ];
}
