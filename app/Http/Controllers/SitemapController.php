<?php

namespace App\Http\Controllers;

use App\Cities;
use App\State;
use App\Country;
use App\Property;
use App\PropertyTypes;
use App\OtherServices;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    // Create index method which will create sitemap
    public function index()
    {
        $property = Property::select('property_url','created_at')->latest()->limit(25000)->get();

  		return response()->view('sitemap.index', [
      		'property'  => $property
  		])->header('Content-Type', 'text/xml');
    }
    
    // Country, State, City, Property Type Sitemap
    public function cscSitemap()
    {
        $propertyType = PropertyTypes::select('property_type','created_at')->get();
        $country = Country::select('name','created_at')->get();
        $state = State::select('name','created_at')->get();

  		return response()->view('sitemap.csc-sitemap', [
      		'country'   => $country,
      		'state'     => $state,
      		'ptype'     => $propertyType
  		])->header('Content-Type', 'text/xml');
    }
    
    // Services Sitemap
    public function serviceSitemap()
    {
        $services = OtherServices::select('url','created_at')->get();
        
        return response()->view('sitemap.services-sitemap', [
            'services'      => $services    
        ])->header('Content-Type', 'text/xml');
    }
    
    // City Sitemap
    public function citySitemap()
    {
        $cities = Cities::select('name','created_at')->get();

  		return response()->view('sitemap.city_sitemap', [
      		'city'      => $cities
  		])->header('Content-Type', 'text/xml');
    }

}
