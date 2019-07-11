<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\User;
use App\Property;
use App\Services;
use App\UserType;
use App\Amenities;
use App\PropertyTypes;
use App\PropertyQuery;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class PropertyController extends Controller
{

    protected $posts_per_page = 12;

    // This is the function for Add New Property by Admin
    public function addProperty(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            // Add Logged In User name to Property
            $add_by = Auth::user()->id;

            $property = new Property;
            if (!empty($request->property_for)) {
                $property_for = $data['property_for'];
            } else {
                return redirect()->back()->with('flash_message_error', 'Property For is Missing!');
            }

            if (!empty($request->property_type)) {
                $property_type = $data['property_type'];
            } else {
                return redirect()->back()->with('flash_message_error', 'Property Type is Missing!');
            }

            if (empty($data['feature'])) {
                $feature = 0;
            } else {
                $feature = 1;
            }
            if (empty($data['commercial'])) {
                $commercial = 0;
            } else {
                $commercial = 1;
            }
            if (empty($data['gym'])) {
                $gym = 0;
            } else {
                $gym = 1;
            }
            if (empty($data['club_house'])) {
                $club_house = 0;
            } else {
                $club_house = 1;
            }
            if (empty($data['play_area'])) {
                $play_area = 0;
            } else {
                $play_area = 1;
            }
            if (empty($data['water_supply'])) {
                $water_supply = 0;
            } else {
                $water_supply = 1;
            }
            if (empty($data['geyser'])) {
                $geyser = 0;
            } else {
                $geyser = 1;
            }
            if (empty($data['visitor_arking'])) {
                $visitor_arking = 0;
            } else {
                $visitor_arking = 1;
            }
            if (empty($data['garden'])) {
                $garden = 0;
            } else {
                $garden = 1;
            }
            if (empty($data['waste_disposal'])) {
                $waste_disposal = 0;
            } else {
                $waste_disposal = 1;
            }
            if (empty($data['power_backup'])) {
                $power_backup = 0;
            } else {
                $power_backup = 1;
            }
            if (empty($data['swimming_pool'])) {
                $swimming_pool = 0;
            } else {
                $swimming_pool = 1;
            }
            if (empty($data['water_storage'])) {
                $water_storage = 0;
            } else {
                $water_storage = 1;
            }
            if (empty($data['security_personnel'])) {
                $security_personnel = 0;
            } else {
                $security_personnel = 1;
            }
            if (empty($data['gated_community'])) {
                $gated_community = 0;
            } else {
                $gated_community = 1;
            }

            $user = new User;
            // Add Builder/Agent with Property
            if (!empty($data['first_name'])) {
                $builder = User::create([
                    'first_name'    => $data['first_name'],
                    'last_name'     => $data['last_name'],
                    'email'         => $data['email'],
                    'password'      => bcrypt($data['password']),
                    'phonecode'     => $data['phonecode'],
                    'phone'         => $data['phone'],
                    'usertype'      => $data['usertype'],
                ]);
            }

            // get Builder id
            if (empty($builder->id)) {
                $builder_id = $data['builder'];
            } else {
                $builder_id = $builder->id;
            }

            // echo "<pre>"; print_r($data); die;

            $value = Property::create([
                'property_name'         => $data['property_name'],
                'property_url'          => $data['slug'],
                'property_type_id'      => $property_type,
                'property_code'         => $data['property_code'],
                'property_price'        => $data['property_price'],
                // 'booking_price'         => $data['booking_price'],
                'description'           => $data['description'],
                'featured'              => $feature,
                'commercial'            => $commercial,
                'map_pass'              => $data['map_passed'],
                'open_sides'            => $data['open_sides'],
                'parea'                 => $data['property_area'],
                'widthroad'             => $data['width_road_facing'],
                'furnish_type'          => $data['furnish_type'],
                'floorno'               => $data['floor_no'],
                'total_floors'          => $data['total_floors'],
                'apple_trees'           => $data['trees'],
                'parea'                 => $data['property_area'],
                // 'pfacing'               => $data['property_facing'],
                'transaction_type'      => $data['transection_type'],
                'construction_status'   => $data['construction_status'],
                'bedrooms'              => $data['bedrooms'],
                'bathrooms'             => $data['bathrooms'],
                'balconies'             => $data['balconies'],
                'p_washrooms'           => $data['p_washroom'],
                'cafeteria'             => $data['cafeteria'],
                'road_facing'           => $data['roadfacing'],
                'c_shop'                => $data['corner_shop'],
                'wall_made'             => $data['boundrywall'],
                'p_showroom'            => $data['pshowroom'],
                'property_age'          => $data['property_age'],
                // 'plotno'                => $data['plot_no'],
                'address1'              => $data['property_address1'],
                'address2'              => $data['property_address2'],
                'locality'              => $data['locality'],
                'country'               => $data['country'],
                'state'                 => $data['state'],
                'city'                  => $data['city'],
                'zipcode'               => $data['zipcode'],
                'add_by'                => $add_by,
                'service_id'            => $property_for,
                'builder'               => $builder_id,
                'agent'                 => $data['agent'],
            ]);

            // Add Amenities
            $amenities = Amenities::create([
                'property_id'       => $value->id,
                'gym'               => $gym,
                'club_house'        => $club_house,
                'play_area'         => $play_area,
                'water_supply'      => $water_supply,
                'geyser'            => $geyser,
                'visitor_arking'    => $visitor_arking,
                'garden'            => $garden,
                'waste_disposal'    => $waste_disposal,
                'power_backup'      => $power_backup,
                'swimming_pool'     => $swimming_pool,
                'water_storage'     => $water_storage,
                'security_personnel' => $security_personnel,
                'gated_community'   => $gated_community,
            ]);

            // echo "<pre>"; print_r($value); die;

            // Upload image
            if ($request->hasFile('file')) {
                $image_array = Input::file('file');
                // if($image_array->isValid()){
                $array_len = count($image_array);
                for ($i = 0; $i < $array_len; $i++) {
                    // $image_name = $image_array[$i]->getClientOriginalName();
                    $image_size = $image_array[$i]->getClientSize();
                    $extension = $image_array[$i]->getClientOriginalExtension();
                    $filename = 'IPC_' . rand(1, 99999) . '.' . $extension;
                    $watermark = Image::make(public_path('/images/frontend_images/images/logo.png'));
                    $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                    $medium_image_path = 'images/backend_images/property_images/medium/' . $filename;
                    $small_image_path = 'images/backend_images/property_images/small/' . $filename;
                    // Resize image
                    Image::make($image_array[$i])->resize(730, 464)->insert($watermark, 'center', 30, 30)->save($large_image_path);

                    // Store image in property folder
                    $property->image = $filename;
                    $propertyimage = PropertyImages::create([
                        'image_name' => $filename,
                        'image_size' => $image_size,
                        'property_id' => $value->id,
                    ]);
                    // }
                }
            } else {
                $filename = "default.jpg";
                $property->image = "default.jpg";
                $propertyimage = PropertyImages::create([
                    'image_name' => $filename,
                    'image_size' => '7.4',
                    'property_id' => $value->id,
                ]);
            }

            return redirect('/admin/add-new-property')->with('flash_message_success', 'Property Added Successfully!');
        }

        $getBuilder = User::where(['usertype' => 'B'])->orderBy('first_name', 'desc')->get();
        $getAgent = User::where(['usertype' => 'A'])->orderBy('first_name', 'desc')->get();
        $servicetype = Services::where(['status' => 1, 'parent_id' => 1])->get();
        $propertytype = PropertyTypes::get();
        $countryname = DB::table('countries')->get();
        $phonecode = DB::table('countries')->get();
        return view('admin.property.add-property', compact('propertytype', 'servicetype', 'countryname', 'getBuilder', 'getAgent', 'phonecode'));
    }

    // Getting State List according to Country
    public function getStateList(Request $request)
    {
        $states = DB::table("states")->where("country", $request->country_id)->pluck("name", "id");
        return response()->json($states);
    }

    // Getting City List according to State
    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")->where("state_id", $request->state_id)->pluck("name", "id");
        return response()->json($cities);
    }

    // Showing Listed Properties By Admin
    public function viewProperty()
    {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);
        $propertyImages = PropertyImages::paginate(10);
        // $properties = json_decode(json_encode($properties));
        $propertyImages = json_decode(json_encode($propertyImages));

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
        }

        return view('admin.property.view-property', compact('properties', 'propertyimage_count'));
    }

    // Delete property Image function
    public function deletePropertyImage(Request $request, $id = null)
    {
        PropertyImages::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Property image Deleted Successfully!');
    }

    // View Single Property
    public function viewSingleProperty(Request $request, $url = null)
    {
        // Show 404 Page on wrong Property url search by visitor
        $propertyCount = Property::where(['property_url' => $url])->count();
        if ($propertyCount == 0) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $pquery = new PropertyQuery;

            $pquery->usertype = $data['user_type'];
            $pquery->name = $data['name'];
            $pquery->email = $data['email'];
            $pquery->phone = $data['phone'];
            $pquery->queryforname = $data['queryforname'];
            $pquery->queryfor = $data['queryfor'];
            $pquery->accept_condition = $data['accept_condition'];

            $pquery->save();

            return redirect()->back()->with('flash_message_success', 'Your Query for this Property Submitted Successfully!');
        }

        // $property = Property::get();
        $properties = Property::where(['property_url' => $url])->orderBy('id', 'asc')->get();
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

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
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $properties[$key]->city_name = $city->name;
            }
            $addby_count = User::where(['id' => $val->add_by])->count();
            if ($addby_count > 0) {
                $addBy = User::where(['id' => $val->add_by])->first();
                $properties[$key]->addby_name = $addBy->first_name;
            }
            $builder_count = User::where(['id' => $val->builder])->count();
            // echo "<pre>"; print_r($builder_count); die;
            if (!empty($builder_count)) {
                $buildername = User::where(['id' => $val->builder])->first();
                $properties[$key]->builder_name = $buildername->first_name;
            }
        }

        // echo "<pre>"; print_r($properties); die;
        $menuServices = Services::get();
        return view('frontend.view_single_property')->with(compact('properties', 'propertyImages', 'country_count', 'state_count', 'city_count'));
        // return view('frontend.view_single_property');
    }

    public function searchByState($state_id = null)
    {
        $statename = DB::table('states')->where(['id' => $state_id])->pluck('name');
        $properties = Property::where(['state' => $state_id])->get();
        $posts = Property::where(['state' => $state_id])->paginate($this->posts_per_page);
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

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
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contRow = 0;
        }
        return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'propertyImages', 'contRow', 'countrycount', 'statecount', 'citycount', 'statename'));
    }

    public function searchByCountry($country_id = null)
    {
        $countryname = DB::table('countries')->where(['iso2' => $country_id])->pluck('name');
        // echo "<pre>"; print_r($countryname); die;
        $properties = Property::where(['country' => $country_id])->get();
        $posts = Property::where(['country' => $country_id])->paginate($this->posts_per_page);
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

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

        if (!empty($properties)) {
            $contRow = count($properties);
            
        } else {
            $contRow = 0;
        }
        // echo "<pre>"; print_r($countryname); die;

        return view('frontend.filter_templates.filter_by_csc', compact('propertyImages', 'contRow', 'countryname', 'posts', 'countrycount'));
    }

    public function searchByCity($city_id = null)
    {
        $cityname = DB::table('cities')->where(['id' => $city_id])->pluck('name');
        $properties = Property::where(['city' => $city_id])->get();
        $posts = Property::where(['city' => $city_id])->paginate($this->posts_per_page);
        // echo "<pre>"; print_r($posts); die;
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
        // echo "<pre>"; print_r($properties); die;
        return view('frontend.filter_templates.filter_by_csc', compact('posts', 'propertyImages', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount'));
    }

    // Search By Service
    public function searchByService($id = null)
    {
        $properties = Property::where(['service_id' => $id])->orderBy('created_at', 'desc')->paginate(18);
        $propertyImages = PropertyImages::get();
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
            if ($city_count > 0) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $properties[$key]->city_name = $city->name;
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
        return view('frontend.filter_templates.filter_by_service')->with(compact('properties', 'propertyImages', 'contRow', 'city', 'countrycount', 'statecount', 'citycount'));
    }

    // Property Query
    public function propertyQuery()
    {
        $propertyquery = PropertyQuery::orderBy('status', 'asc')->get();
        return view('admin.queries.property_query', compact('propertyquery'));
    }

    // Property Query Done
    public function queryDone(Request $request, $id = null)
    {
        if (!empty($id)) {
            PropertyQuery::where(['id' => $id])->update(['status' => 1]);
            return redirect()->back()->with('flash_message_success', 'Query Status Changed Successfully!');
        }
    }

    // Property Query Pending
    public function queryPending(Request $request, $id = null)
    {
        if (!empty($id)) {
            PropertyQuery::where(['id' => $id])->update(['status' => 0]);
            return redirect()->back()->with('flash_message_success', 'Query Status Changed Successfully!');
        }
    }

    // Edit Property Function
    public function editProperty(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Add Logged In User name to Property
            $add_by = Auth::user()->id;

            if (empty($data['feature'])) {
                $feature = 0;
            } else {
                $feature = 1;
            }
            if (empty($data['commercial'])) {
                $commercial = 0;
            } else {
                $commercial = 1;
            }
            if (empty($data['gym'])) {
                $gym = 0;
            } else {
                $gym = 1;
            }
            if (empty($data['club_house'])) {
                $club_house = 0;
            } else {
                $club_house = 1;
            }
            if (empty($data['play_area'])) {
                $play_area = 0;
            } else {
                $play_area = 1;
            }
            if (empty($data['water_supply'])) {
                $water_supply = 0;
            } else {
                $water_supply = 1;
            }
            if (empty($data['geyser'])) {
                $geyser = 0;
            } else {
                $geyser = 1;
            }
            if (empty($data['visitor_arking'])) {
                $visitor_arking = 0;
            } else {
                $visitor_arking = 1;
            }
            if (empty($data['garden'])) {
                $garden = 0;
            } else {
                $garden = 1;
            }
            if (empty($data['waste_disposal'])) {
                $waste_disposal = 0;
            } else {
                $waste_disposal = 1;
            }
            if (empty($data['power_backup'])) {
                $power_backup = 0;
            } else {
                $power_backup = 1;
            }
            if (empty($data['swimming_pool'])) {
                $swimming_pool = 0;
            } else {
                $swimming_pool = 1;
            }
            if (empty($data['water_storage'])) {
                $water_storage = 0;
            } else {
                $water_storage = 1;
            }
            if (empty($data['security_personnel'])) {
                $security_personnel = 0;
            } else {
                $security_personnel = 1;
            }
            if (empty($data['gated_community'])) {
                $gated_community = 0;
            } else {
                $gated_community = 1;
            }

            // echo "<pre>"; print_r($data); die;

            if ($request->hasFile('file')) {
                $image_array = Input::file('file');
                $array_len = count($image_array);
                for ($i = 0; $i < $array_len; $i++) {
                    // if($image_tmp->isValid()){
                    $image_size = $image_array[$i]->getClientSize();
                    $extension = $image_array[$i]->getClientOriginalExtension();
                    $filename = 'IPC_' . rand(1, 99999) . '.' . $extension;
                    $watermark = Image::make(public_path('/images/frontend_images/images/logo.png'));
                    $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                    $medium_image_path = 'images/backend_images/property_images/medium/' . $filename;
                    $small_image_path = 'images/backend_images/property_images/small/' . $filename;
                    // Resize image
                    Image::make($image_array[$i])->resize(730, 464)->insert($watermark, 'center', 30, 30)->save($large_image_path);
                    // Store image in property folder
                    PropertyImages::create([
                        'image_name' => $filename,
                        'image_size' => $image_size,
                        'property_id' => $id
                    ]);
                    // } 
                    if (!empty($filename)) {
                        PropertyImages::where(['property_id' => $id])->update(['image_name' => $filename]);
                    }
                }
            } else {
                $propertyimg_count = PropertyImages::where(['property_id' => $id])->count();
                if(empty($propertyimg_count)) {
                    $filename = "default.jpg";
                    PropertyImages::create([
                        'image_name' => $filename,
                        'image_size' => '75',
                        'property_id' => $id
                    ]);
                }
            }

            // if(!empty($id)){
            // Update Property Details
            Property::where(['id' => $id])->update([
                'property_name' => $data['property_name'], 'property_url' => $data['slug'], 'service_id' => $data['property_for'], 'property_type_id' => $data['property_type'], 'property_price' => $data['property_price'], 'description' => $data['description'], 'featured' => $feature, 'commercial' => $commercial,
                'map_pass' => $data['map_passed'], 'open_sides' => $data['open_sides'], 'parea' => $data['property_area'], 'widthroad' => $data['width_road_facing'], 'furnish_type' => $data['furnish_type'], 'floorno' => $data['floor_no'], 'total_floors' => $data['total_floors'], 'apple_trees' => $data['trees'], 'transaction_type' => $data['transection_type'], 'construction_status' => $data['construction_status'],
                'bedrooms' => $data['bedrooms'], 'bathrooms' => $data['bathrooms'], 'balconies' => $data['balconies'], 'p_washrooms' => $data['p_washroom'], 'cafeteria' => $data['cafeteria'], 'road_facing' => $data['roadfacing'], 'c_shop' => $data['corner_shop'], 'wall_made' => $data['boundrywall'], 'p_showroom' => $data['pshowroom'], 'property_age' => $data['property_age'],
                'address1' => $data['property_address1'], 'address2' => $data['property_address2'], 'locality' => $data['locality'], 'country' => $data['country'], 'state' => $data['state'], 'city' => $data['city'], 'zipcode' => $data['zipcode'], 'add_by' => $add_by, 'builder' => $data['builder'], 'agent' => $data['agent']
            ]);
            // Update Amenities
            Amenities::where(['property_id' => $id])->update([
                'gym' => $gym, 'club_house' => $club_house, 'play_area' => $play_area, 'water_supply' => $water_supply, 'geyser' => $geyser, 'visitor_arking' => $visitor_arking, 'garden' => $garden,
                'waste_disposal' => $waste_disposal, 'power_backup' => $power_backup, 'swimming_pool' => $swimming_pool, 'water_storage' => $water_storage, 'security_personnel' => $security_personnel, 'gated_community' => $gated_community
            ]);
            // Update Images
            // }

            return redirect('/admin/properties')->with('flash_message_success', 'Property Updated Successfulley');
        }

        // Get Properties
        $properties = Property::where(['id' => $id])->first();
        $properties = json_decode(json_encode($properties));
        // Get Property Images
        $propertyImage = PropertyImages::where(['property_id' => $id])->get();

        // Get Property Amenities
        foreach ($properties as $key => $val) {
            $pamenities_count = Amenities::where(['property_id' => $id])->count();
            if ($pamenities_count > 0) {
                $pamenities = Amenities::where(['property_id' => $id])->first();
                $properties->gym = $pamenities->gym;
                $properties->club_house = $pamenities->club_house;
                $properties->play_area = $pamenities->play_area;
                $properties->water_supply = $pamenities->water_supply;
                $properties->geyser = $pamenities->geyser;
                $properties->visitor_arking = $pamenities->visitor_arking;
                $properties->garden = $pamenities->garden;
                $properties->waste_disposal = $pamenities->waste_disposal;
                $properties->power_backup = $pamenities->power_backup;
                $properties->swimming_pool = $pamenities->swimming_pool;
                $properties->water_storage = $pamenities->water_storage;
                $properties->security_personnel = $pamenities->security_personnel;
                $properties->gated_community = $pamenities->gated_community;
            }
        }

        // Select Property for
        $propertyfor = Services::where('parent_id', '!=', '0')->get();
        $propertyfor_dropdown = "<option selected value=''>Property for</option>";
        foreach ($propertyfor as $pf) {
            if ($pf->id == $properties->service_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $propertyfor_dropdown .= "<option value='" . $pf->id . "' " . $selected . ">" . $pf->service_name . "</option>";
        }

        // Select Property Type
        $propertytype = PropertyTypes::where('status', '1')->get();
        $propertytype_dropdown = "<option selected value=''>Property Type</option>";
        foreach ($propertytype as $pt) {
            if ($pt->property_type_code == $properties->property_type_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $propertytype_dropdown .= "<option value='" . $pt->property_type_code . "' " . $selected . ">" . $pt->property_type . "</option>";
        }

        // Select Builder
        $getBuilder = User::where(['usertype' => 'B'])->orderBy('first_name', 'desc')->get();
        $builder_dropdown = "<option selected value=''>Select Builder</option>";
        foreach ($getBuilder as $gb) {
            if ($gb->id == $properties->builder) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $builder_dropdown .= "<option value='" . $gb->id . "' " . $selected . ">" . $gb->first_name . " " . $gb->last_name . "</option>";
        }

        // Select Agent
        $getAgent = User::where(['usertype' => 'A'])->orderBy('first_name', 'desc')->get();
        $agent_dropdown = "<option selected value=''>Select Agent</option>";
        foreach ($getAgent as $ga) {
            if ($ga->id == $properties->agent) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $agent_dropdown .= "<option value='" . $ga->id . "' " . $selected . ">" . $ga->first_name . " " . $ga->last_name . "</option>";
        }
        $servicetype = Services::where(['status' => 1, 'parent_id' => 1])->get();

        // Country Dropdown
        $countryname = DB::table('countries')->get();
        $country_dropdown = "<option selected value=''>Select Country</option>";
        foreach ($countryname as $cont) {
            if ($cont->iso2 == $properties->country) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $country_dropdown .= "<option value='" . $cont->iso2 . "' " . $selected . ">" . $cont->name . "</option>";
        }

        // State Dropdown
        $statename = DB::table('states')->where(['country' => $properties->country])->get();
        $state_dropdown = "<option selected value=''>Select State</option>";
        foreach ($statename as $stn) {
            if ($stn->id == $properties->state) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $state_dropdown .= "<option value='" . $stn->id . "' " . $selected . ">" . $stn->name . "</option>";
        }

        // City Dropdown
        $cityname = DB::table('cities')->where(['state_id' => $properties->state])->get();
        $city_dropdown = "<option selected value=''>Select City</option>";
        foreach ($cityname as $city) {
            if ($city->id == $properties->city) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $city_dropdown .= "<option value='" . $city->id . "' " . $selected . ">" . $city->name . "</option>";
        }

        // Select Country Phone Code
        $phonecode = DB::table('countries')->get();
        // echo "<pre>"; print_r($propertyImage); die;
        return view('admin.property.edit_property', compact('properties', 'propertyImage', 'getBuilder', 'getAgent', 'servicetype', 'propertytype', 'countryname', 'phonecode', 'propertyfor_dropdown', 'propertytype_dropdown', 'builder_dropdown', 'agent_dropdown', 'country_dropdown', 'state_dropdown', 'city_dropdown'));
    }

    // Delete Property Function
    public function deleteProperty(Request $request, $id = null)
    {
        if (!empty($id)) {
            Property::where(['id' => $id])->delete();

            return redirect()->back()->with('flash_message_success', 'Property Deleted Successfully!');
        }
        // return ('<h2>Coming Soon!</h2>');
    }

    // Creating unique Slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Property::class, 'property_url', $request->property_name, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }
}
