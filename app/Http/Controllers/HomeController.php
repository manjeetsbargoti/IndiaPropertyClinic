<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;
use App\User;
use App\Cities;
use App\Services;
use App\Property;
use App\PropertyTypes;
use App\OtherServices;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    protected $posts_per_page = 9;

    public function index()
    {
        $properties1 = Property::where('service_id', 2)->orderBy('id', 'asc')->take(4)->get();
        $properties1 = json_decode(json_encode($properties1));
        $properties2 = Property::where('service_id', 3)->orderBy('id', 'asc')->take(4)->get();
        $properties2 = json_decode(json_encode($properties2));
        $properties3 = Property::where('service_id', 4)->orderBy('id', 'asc')->take(4)->get();
        $properties3 = json_decode(json_encode($properties3));
        $properties = array_merge($properties1, $properties2, $properties3);
        $featureProperty = Property::where(['featured' => 1])->take(4)->get();
        $propertyImages = PropertyImages::get();
        $propertyType = PropertyTypes::get();
        $otherServices = OtherServices::get();
        // $properties = json_decode(json_encode($properties));

        // echo "<pre>"; print_r($properties); die;

        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $propertyimage_name->image_name;
            }
            $country_count = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $properties[$key]->country_name = $country->name;
                $properties[$key]->currency = $country->currency;
            }
            $state_count = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_count > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $properties[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_count) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $properties[$key]->city_name = $city->name;
            }
        }

        foreach ($featureProperty as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $featureProperty[$key]->service_name = $service_name->service_name;
            $country_countf = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_countf > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $featureProperty[$key]->country_name = $country->name;
                $featureProperty[$key]->currency = $country->currency;
            }
            $state_countf = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_countf > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $featureProperty[$key]->state_name = $state->name;
            }
            $city_countf = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_countf) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $featureProperty[$key]->city_name = $city->name;
            }
        }
        if ($country_count > 0) {
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        // echo "<pre>"; print_r($properties); die;
        if (!empty($state_count)) {
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if (!empty($city_count)) {
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }

        $dealer = User::where(['usertype' => 'A'])->orWhere(['usertype' => 'B'])->orderBy('created_at', 'desc')->get();
        $dealer = json_decode(json_encode($dealer));

        $services = Services::where(['status' => 1])->get();
        $continents = DB::table('continents')->get();
        $countries = DB::table('countries')->get();
        // echo "<pre>"; print_r($dealer); die;

        // Meta tags
        $meta_title = "India Property Clinic | Property Listing and Repairing Services";
        $meta_description = "India Property Clinic | Property Listing and Repairing Services";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services";

        return view('home')->with(compact('properties', 'dealer', 'propertyImages', 'featureProperty', 'otherServices', 'services', 'propertyType', 'continents', 'countries', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    // View All Properties
    public function viewAll()
    {
        $property_count = Property::count();
        $properties = Property::orderBy('created_at', 'desc')->paginate(24);
        $posts = Property::orderBy('created_at', 'desc')->paginate(24);
        $propertyImages = PropertyImages::get();
        $otherServices = OtherServices::get();

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $posts[$key]->image_name = $propertyimage_name->image_name;
            }
            $country_count = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $posts[$key]->country_name = $country->name;
                $posts[$key]->currency = $country->currency;
            }
            $state_count = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_count > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $posts[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_count > 0) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $posts[$key]->city_name = $city->name;
            }
        }
        if (!empty($country_count)) {
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        if (!empty($state_count)) {
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if (!empty($city_count)) {
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }

        if (!empty($properties)) {
            $contRow = $property_count;
            // echo "<pre>"; print_r($contRow); die;
        }
        // echo "<pre>"; print_r($posts); die;
        return view('frontend.viewall_properties', compact('properties', 'propertyImages', 'otherServices', 'contRow', 'posts', 'countrycount', 'statecount', 'citycount'));
        // return response()->json($posts);
    }

    // Home Page Search Function Start
    public function search(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('cities')->where('name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="jiodropdown">';
            foreach ($data as $row) {
                $flag = '<span class="flag_name">' . $row->id . '</span>';
                $output .= '<li>' . $row->name . '</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    // Home Page Search-Result Function Start
    public function searchresult(Request $request)
    {
        $data = $request->all();
        $scityname = rtrim($data['search_text']);
        $scityID = $data['property_cat'];
        $scityname = json_decode(json_encode($scityname));
        $scityID = json_decode(json_encode($scityID));
        // echo  '<pre>'; print_r($data); die;
        $city = Cities::where(['name' => rtrim($data['search_text'])])->get();
        $city = json_decode(json_encode($city), true);

        if (empty($data['search_text'])) {
            $properties = Property::where(['property_type_id' => $data['property_type'], 'service_id' => $data['property_cat']])->get();
        } elseif (empty($data['property_type']) && !empty($city[0])) {
            $r = $city[0];
            $properties = Property::where(['city' => $r['id'], 'service_id' => $data['property_cat']])->get();
        } elseif (empty($data['search_text']) && empty($data['property_type'])) {
            $properties = Property::where(['service_id' => $data['property_cat']])->get();
        } else {
            $r = null;
            $properties = Property::where(['city' => $r['id'], 'property_type_id' => $data['property_type'], 'service_id' => $data['property_cat']])->get();
        }

        $propertyImages = PropertyImages::get();
        if (!empty($properties)) {
            $properties = json_decode(json_encode($properties));
        }
        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $propertyimage_name->image_name;
            }
            $country_count = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $properties[$key]->country_name = $country->name;
                $properties[$key]->currency = $country->currency;
            }
            $state_count = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_count > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $properties[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_count > 0) {
                $cityname = DB::table('cities')->where(['id' => $val->city])->first();
                $properties[$key]->city_name = $cityname->name;
            }
        }
        if (!empty($country_count)) {
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        if (!empty($state_count)) {
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if (!empty($city_count)) {
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }

        if (!empty($properties)) {
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contRow = 0;
        }

        // echo "<pre>"; print_r($scityname); die;
        return view('frontend.filter_templates.search_result')->with(compact('properties', 'propertyImages', 'contRow', 'countrycount', 'statecount', 'citycount', 'scityname'));
    }


    //Sidebar filter
    public function filter(Request $request)
    {
        if (isset($request->id)) {
            if ($request->id == 1) {
                $id = 'desc';
                $type = 'created_at';
            } else {
                $id = $request->id;
                $type = 'property_price';
            }
        } else {
            $id = 'desc';
            $type = 'created_at';
        }
        $service    =   $request->service;
        $room       =   $request->room;
        $bedroom    =   $request->bed;
        $bathroom   =   $request->bathroom;

        $posts = DB::table('properties')->where(function ($query) use ($service) {
            if (isset($service)) {
                $query->whereIn('service_id', $service);
            }
        })->where(function ($query) use ($room) {
            if (isset($room)) {
                $query->whereIn('rooms', $room);
            }
        })->where(function ($query) use ($bedroom) {
            if (isset($bedroom)) {
                $query->whereIn('bedrooms', $bedroom);
            }
        })->where(function ($query) use ($bathroom) {
            if (isset($bathroom)) {
                $query->whereIN('bathrooms', $bathroom);
            }
        })->orderBy($type, $id);

        $breadcrumb = $posts->get();
        $posts = $posts->paginate($this->posts_per_page);


        $propertyImages = PropertyImages::get();

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $posts[$key]->image_name = $propertyimage_name->image_name;
            }
            $country_count = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $posts[$key]->country_name = $country->name;
                $posts[$key]->currency = $country->currency;
            }
            $state_count = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_count > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $posts[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_count > 0) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $posts[$key]->city_name = $city->name;
            }
        }


        if (!empty($breadcrumb)) {
            $contRow = $breadcrumb->count();
        }

        $output = '';

        echo '<div class="header_breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="' . url('/') . '">Home</a></li>
                        <li class="breadcrumb-item">All Properties</li>
                    </ol>
                </nav>
                <p><span>' . $contRow . ' Properties </span> </p>
            </div>';
        // echo '';
        if (!$posts->isEmpty()) {
            echo '<div class="row posts endless-pagination" data-next-page="' . $posts->nextPageUrl() . '" >';
            foreach ($posts as $property) {
                echo '<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_box">
                        <div class="product_img">
                            <div class="owl-carousel product-slide owl-theme">';
                foreach (explode(',', $property->images) as $image) {
                        echo '<div class="item"><img src="' . asset('/images/backend_images/property_images/large/' . $image) . '"></div>';
                }
                echo '</div>
                            <div class="bottom_strip">
                                <h6><i class="fas fa-map-marker-alt"></i> ';
                if (!empty($property->city_name)) {
                    echo '<span>' . $property->city_name . ',</span>';
                } {
                    if (!empty($property->country_name))
                        echo '<span>' . $property->country_name . '</span>';
                }
                echo '</h6>
                                <p>' . $property->parea . 'Square Ft</p>
                                <span class="tagbtn rent">' . $property->service_name . '</span>
                            </div> 
                        </div>
                        <div class="product_text">
                            <div class="protxt_top">
                                <ul>
                                    <li><i><img src="/images/frontend_images/images/room.svg"></i><p><span>' . $property->rooms . '</span>Rooms</p></li>
                                    <li><i><img src="/images/frontend_images/images/bedroom.svg"></i><p><span>' . $property->bedrooms . '</span>Bedrooms</p></li>
                                    <li><i><img src="/images/frontend_images/images/bathroom.svg"></i><p><span>' . $property->bathrooms . '</span>Bathroom</p></li>
                                </ul>
                            </div>
                            <div class="protxt_inn">
                                <h6>' . $property->property_name . '</h6>
                                <p>' . strip_tags($property->description) . '</p>
                                <div class="price_sec">
                                    <ul>
                                        <li>';
                if (!empty($property->property_price)) {
                    echo '<h5><span>' . $property->currency . '</span> ' . $property->property_price . '</h5>';
                } else {
                    echo '<a href="/properties/' . $property->property_url . '" class="btn_fullinfo">Get Price</a>';
                }
                echo '</li>
                                        <li><a href="/properties/' . $property->property_url . '" class="btn_fullinfo">Full Info</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                ';
            }
            echo '</div>';
            $output .= '<div class="product_loadding">
        ' . $posts->render() . '
         </div>';
        } else {
            $output .= '
        <div class="container">
            <div class="globleheadding">
                <img src="' . asset('/images/backend_images/user_images/error-no-search-results.png') . '">
                <h4>Sorry, no results found!</h4>
                <p>Oh Snap! Zero Results found for your search.</p>
            </div>
        </div>

        ';
        }
        return $output;
    }
}
