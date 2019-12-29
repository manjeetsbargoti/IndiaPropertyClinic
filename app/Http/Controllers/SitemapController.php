<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    // Create index method which will create sitemap
    public function index()
    {
        $property = Property::latest()->limit(20000)->get();

  		return response()->view('sitemap.index', [
      		'property' => $property,
  		])->header('Content-Type', 'text/xml');
    }

}
