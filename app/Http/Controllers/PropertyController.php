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

            // Data test code
            // echo "<pre>"; print_r($data); die;

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

            if (empty($data['feature'])) { $feature = 0; } else { $feature = 1; }

            if (empty($data['gym'])) { $gym = 0; } else { $gym = 1; }
            if (empty($data['club_house'])) { $club_house = 0; } else { $club_house = 1; }
            if (empty($data['play_area'])) { $play_area = 0; } else { $play_area = 1; }
            if (empty($data['water_supply'])) { $water_supply = 0; } else { $water_supply = 1; }
            if (empty($data['geyser'])) { $geyser = 0; } else { $geyser = 1; }
            if (empty($data['visitor_arking'])) { $visitor_arking = 0; } else { $visitor_arking = 1; }
            if (empty($data['garden'])) { $garden = 0; } else { $garden = 1; }
            if (empty($data['waste_disposal'])) { $waste_disposal = 0; } else { $waste_disposal = 1; }
            if (empty($data['power_backup'])) { $power_backup = 0; } else { $power_backup = 1; }
            if (empty($data['swimming_pool'])) { $swimming_pool = 0; } else { $swimming_pool = 1; }
            if (empty($data['water_storage'])) { $water_storage = 0; } else { $water_storage = 1; }

            $user = new User;
            // Add Builder/Agent with Property
            if(!empty($data['first_name']))
            {
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
                    $filename = 'india_property_clinic' . rand(1, 99999) . '.' . $extension;
                    $watermark = Image::make(public_path('/images/frontend_images/images/logo.png'));
                    $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                    $medium_image_path = 'images/backend_images/property_images/medium/' . $filename;
                    $small_image_path = 'images/backend_images/property_images/small/' . $filename;
                    // Resize image
                    Image::make($image_array[$i])->resize(730, 464)->insert($watermark, 'center', 30, 30)->save($large_image_path);

                    // Store image in property folder
                    $property->image = $filename;
                    PropertyImages::create([
                        'image_name' => $filename,
                        'image_size' => $image_size,
                        'property_id' => $value->id,
                    ]);
                    // }
                }
            } else {
                $filename = "default.jpg";
                $property->image = "default.jpg";
                PropertyImages::create([
                    'image_name' => $filename,
                    'image_size' => '7.4',
                    'property_id' => $value->id,
                ]);
            }

            return redirect('/admin/properties')->with('flash_message_success', 'Property Added Successfully!');
        }

        $getBuilder = User::where(['usertype'=>'B'])->orderBy('first_name', 'desc')->get();
        $getAgent = User::where(['usertype'=>'A'])->orderBy('first_name', 'desc')->get();
        $servicetype = Services::where(['status' => 1, 'parent_id' => 1])->get();
        $propertytype = PropertyTypes::get();
        $countryname = DB::table('countries')->pluck("name", "id");
        $phonecode = DB::table('countries')->get();
        return view('admin.property.add-property', compact('propertytype', 'servicetype', 'countryname', 'getBuilder', 'getAgent','phonecode'));
    }

    // Getting State List according to Country
    public function getStateList(Request $request)
    {
        $states = DB::table("states")->where("country_id", $request->country_id)->pluck("name", "id");
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
        $properties = Property::orderBy('created_at', 'desc')->get();
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));
        $propertyImages = json_decode(json_encode($propertyImages));

        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $propertyimage_name->image_name;
            }
        }

        return view('admin.property.view-property', compact('properties', 'propertyimage_count'));
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
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $properties[$key]->country_name = $country->name;
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
            $addby_count = User::where(['id'=>$val->add_by])->count();
            if($addby_count > 0){
                $addBy = User::where(['id'=>$val->add_by])->first();
                $properties[$key]->addby_name = $addBy->first_name;
            }
            $builder_count = User::where(['id'=>$val->builder])->count();
            // echo "<pre>"; print_r($builder_count); die;
            if(!empty($builder_count)){
                $buildername = User::where(['id'=>$val->builder])->first();
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
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $posts[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $posts[$key]->country_name = $country->name;
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
        $countryname = DB::table('countries')->where(['id' => $country_id])->pluck('name');
        $properties = Property::where(['country' => $country_id])->get();
        $posts = Property::where(['country' => $country_id])->paginate($this->posts_per_page);
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $posts[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $posts[$key]->country_name = $country->name;
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
            // echo "<pre>"; print_r($contRow); die;
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
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $posts[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $posts[$key]->country_name = $country->name;
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
        return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'propertyImages', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount'));
    }

    // Search By Service
    public function searchByService($id = null)
    {
        $properties = Property::where(['service_id' => $id])->orderBy('created_at', 'desc')->get();
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $properties[$key]->country_name = $country->name;
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
        return ('<h2>Coming Soon!</h2>');
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
