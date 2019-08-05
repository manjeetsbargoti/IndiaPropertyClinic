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
        $footerProperties = Property::orderBy('created_at', 'desc')->take(2)->get();
        $footerProperties = json_decode(json_encode($footerProperties));

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $footerProperties[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id'=>$val->id])->count();
            if($propertyimage_count > 0){
                $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
                $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            }
            $country_count = DB::table('countries')->where(['id'=>$val->country])->count();
            if($country_count > 0){
                $country = DB::table('countries')->where(['id'=>$val->country])->first();
                $footerProperties[$key]->country_name = $country->name;
                $footerProperties[$key]->currency = $country->currency;
            }
            $state_count = DB::table('states')->where(['id'=>$val->state])->count();
            if($state_count > 0){
                $state = DB::table('states')->where(['id'=>$val->state])->first();
                $footerProperties[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id'=>$val->city])->count();
            if($city_count > 0){
                $city = DB::table('cities')->where(['id'=>$val->city])->first();
                $footerProperties[$key]->city_name = $city->name;
            }
        }
        // echo "<pre>"; print_r($footerProperties); die;
        return $footerProperties;
    }

    // Meta Tags
    public static function metaKeywords()
    {
        $metakey = Property::get();
        $metakey = json_decode(json_encode($metakey));

        return $metakey;
    }

    // Continent's List
    public static function continents()
    {
        $continent = DB::table('continents')->get();
        $continent = json_decode(json_encode($continent));

        // echo "<pre>"; print_r($continent); die;

        return $continent;
    }

    // Country List
    public static function countries()
    {
        $country = DB::table('countries')->get();
        $country = json_decode(json_encode($country));

        // echo "<pre>"; print_r($country); die;

        return $country;
    }
}
