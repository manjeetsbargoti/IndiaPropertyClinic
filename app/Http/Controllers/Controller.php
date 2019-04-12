<?php

namespace App\Http\Controllers;

use DB;
use App\Services;
use App\Property;
use App\PropertyImages;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function mainNav()
    {
        $mainnavservice = Services::where('parent_id', '!=', 0)->get();
        $mainnavservice = json_decode(json_encode($mainnavservice));
        // echo "<pre>"; print_r($mainnavservice); die;
        return $mainnavservice;
    }

    public static function footersection()
    {
        $footerProperties = Property::orderBy('created_at', 'desc')->get();
        $footerProperties = json_decode(json_encode($footerProperties));

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            // $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $footerProperties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $footerProperties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $footerProperties[$key]->city_name = $city->name;
        }

        // echo "<pre>"; print_r($footerProperties); die;
        return $footerProperties;

    }
}
