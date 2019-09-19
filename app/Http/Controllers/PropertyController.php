<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\User;
use App\Country;
use App\Property;
use App\Services;
use App\UserType;
use App\Amenity;
use App\Cities;
use App\State;
use App\PhoneQuery;
use App\PropertyTypes;
use App\PropertyQuery;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class PropertyController extends Controller
{

    protected $posts_per_page = 21;

    // This is the function for Add New Property by Admin
    public function addProperty(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $property_code = 'IPC'.rand(00001, 999999999);

            // echo "<pre>"; print_r($data); die;

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
            if(!empty($data['amenity'])){
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            }else{
                $amenity = '';
            }

            DB::beginTransaction();

            try {
                $user = new User;
                // Add Builder/Agent with Property
                if (!empty($data['first_name'])) {
                        $user->first_name    = $data['first_name'];
                        $user->last_name     = $data['last_name'];
                        $user->email         = $data['email'];
                        $user->password      = bcrypt($data['password']);
                        $user->phonecode     = $data['phonecode'];
                        $user->phone         = $data['phone'];
                        $user->usertype      = $data['usertype'];

                        $user->save();
                        // echo "<pre>"; print_r($user); die;
                }
            }catch(ValidationException $e){
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            }catch(\Exception $e){
                DB::rollback();
                throw $e;
            }

            try {
                // get Builder id
                if (empty($user->id)) {
                    $builder_id = $data['builder'];
                } else {
                    $builder_id = $user->id;
                }

                // echo "<pre>"; print_r($builder_id); die;

                $value = Property::create([
                    'property_name'         => $data['property_name'],
                    'property_url'          => $data['slug'],
                    'property_type_id'      => $property_type,
                    'property_code'         => $property_code,
                    'property_price'        => $data['property_price'],
                    // 'booking_price'         => $data['booking_price'],
                    'description'           => $data['description'],
                    'featured'              => $feature,
                    'commercial'            => $commercial,
                    'amenities'             => $amenity,
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
                    'meta_title'            => $data['meta_title'],
                    'meta_description'      => $data['meta_description'],
                    'meta_keywords'         => $data['meta_keywords'],
                ]);
            }catch(ValidationException $e){
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            }catch(\Exception $e){
                DB::rollback();
                throw $e;
            }

            // echo "<pre>"; print_r($value); die;

            // Upload image
            try{
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
            }catch(ValidationException $e){
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            }catch(\Exception $e){
                DB::rollback();
                throw $e;
            }

            DB::commit();

            return redirect('/admin/add-new-property')->with('flash_message_success', 'Property Added Successfully!');
        }

        $getBuilder = User::where(['usertype' => 'B'])->orderBy('first_name', 'desc')->get();
        $getAgent = User::where(['usertype' => 'A'])->orderBy('first_name', 'desc')->get();
        $servicetype = Services::where(['status' => 1, 'parent_id' => 1])->get();
        $propertytype = PropertyTypes::get();
        $amenities = Amenity::where('status', 1)->orderBy('name', 'asc')->get();
        $countryname = DB::table('countries')->get();
        $phonecode = DB::table('countries')->get();
        return view('admin.property.add-property', compact('propertytype', 'servicetype', 'countryname', 'getBuilder', 'getAgent', 'phonecode', 'amenities'));
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
        $userid = Auth::user()->id;
        if(Auth::user()->admin == 1 || Auth::user()->usertype == 'S'){
            $properties = Property::orderBy('created_at', 'desc')->paginate(10);
        }else{
            $properties = Property::where('add_by', $userid)->orderBy('created_at', 'desc')->paginate(10);
        }

        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyimage_count > 0) {
                $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
                $properties[$key]->image_name = $propertyimage_name->image_name;
            }
            $property_addby = User::where('id', $val->add_by)->first();
            $properties[$key]->user_fname = $property_addby->first_name;
            $properties[$key]->user_lname = $property_addby->last_name;
            $properties[$key]->user_id = $property_addby->id;

            $property_agent_count = User::where('id', $val->agent)->count();
            if($property_agent_count > 0){
                $property_agent = User::where('id', $val->agent)->first();
                $properties[$key]->agent_fname = $property_agent->first_name;
                $properties[$key]->agent_lname = $property_agent->last_name;
                $properties[$key]->agent_id = $property_agent->id;
            }

            $property_builder_count = User::where('id', $val->builder)->count();
            if($property_builder_count > 0){
                $property_builder = User::where('id', $val->builder)->first();
                $properties[$key]->builder_fname = $property_builder->first_name;
                $properties[$key]->builder_lname = $property_builder->last_name;
                $properties[$key]->builder_id = $property_builder->id;
            }

            $country_count = DB::table('countries')->where(['iso2' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['iso2' => $val->country])->first();
                $properties[$key]->country_name = $country->name;
                $properties[$key]->currency = $country->currency;
            }
        }

        return view('admin.property.view-property', compact('properties'));
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
        $p_location = Property::select('city', 'state', 'country', 'service_id')->where(['property_url' => $url])->first();
        // echo "<pre>"; print_r($p_location); die;
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
        $properties = json_decode(json_encode($properties));

        foreach ($properties as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            
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
                $properties[$key]->addby_name   = $addBy->first_name;
                $properties[$key]->status       = $addBy->status;
            }
            $builder_count = User::where(['id' => $val->builder])->count();
            // echo "<pre>"; print_r($builder_count); die;
            if (!empty($builder_count)) {
                $buildername = User::where(['id' => $val->builder])->first();
                $properties[$key]->builder_name = $buildername->first_name;
                $properties[$key]->status = $buildername->status;
            }

            $agent_count = User::where(['id' => $val->agent])->count();
            // echo "<pre>"; print_r($agent_count); die;
            if (!empty($agent_count)) {
                $agentname = User::where(['id' => $val->agent])->first();
                $properties[$key]->agent_name = $agentname->first_name;
                $properties[$key]->status = $agentname->status;
            }
        }

        $property_l_city_count = Property::where('city', $p_location->city)->where('service_id', $p_location->service_id)->count();
        $property_l_city_state = Property::where('state', $p_location->state)->count();
        $property_l_city_country = Property::where('country', $p_location->country)->count();
        if($property_l_city_count > 2)
        {
            $property_on_location = Property::where('city', $p_location->city)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        }elseif($property_l_city_state > 2){
            $property_on_location = Property::where('state', $p_location->state)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        }elseif($property_l_city_country > 0){
            $property_on_location = Property::where('country', $p_location->country)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        }

        // echo "<pre>"; print_r($properties); die;
        $menuServices = Services::get();
        return view('frontend.view_single_property')->with(compact('properties', 'country_count', 'state_count', 'city_count', 'property_on_location'));
        // return view('frontend.view_single_property');
    }

    public function searchByState(Request $request, $state_id = null)
    {
        // $stid = $request->get('state_id');
        // echo "<pre>"; print_r($stid); die;
        
        $statename = DB::table('states')->where(['name' => $state_id])->pluck('name');
        // $statename = $state_id;
        $sid = State::where('name', $state_id)->first();
        $properties = Property::where(['state' => $sid['id']])->get();
        $posts = Property::where(['state' => $sid['id']])->paginate($this->posts_per_page);
        $properties = json_decode(json_encode($properties));

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            
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

        // $state_metaname = State::where('id', $state_id)->first();
        $meta_title = "All Properties in ".$state_id." | India Property Clinic | IPC";
        $meta_description = "India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";

        return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'contRow', 'countrycount', 'statecount', 'citycount', 'statename', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function searchByCountry($country_id = null)
    {
        $countryname = DB::table('countries')->where(['iso2' => $country_id])->pluck('name');
        // echo "<pre>"; print_r($countryname); die;
        $properties = Property::where(['country' => $country_id])->get();
        $posts = Property::where(['country' => $country_id])->paginate($this->posts_per_page);
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

        $country_metaname = Country::where('iso2', $country_id)->first();
        $meta_title = "All Properties in ".$country_metaname->name." | India Property Clinic | IPC";
        $meta_description = "India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        
        // echo "<pre>"; print_r($meta_name); die;

        return view('frontend.filter_templates.filter_by_csc', compact('contRow', 'countryname', 'posts', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    public function searchByCity($city_id = null)
    {
        $cityname = DB::table('cities')->where(['name' => $city_id])->pluck('name');
        $cid = Cities::where('name', $city_id)->first();
        $properties = Property::where(['city' => $cid['id']])->get();
        $posts = Property::where(['city' => $cid['id']])->paginate($this->posts_per_page);
        // echo "<pre>"; print_r($posts); die;

        foreach ($posts as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            
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

        $city_metaname = Cities::where('name', $city_id)->first();
        $meta_title = "All Properties in ".$city_metaname->name." | India Property Clinic | IPC";
        $meta_description = "India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";

        // echo "<pre>"; print_r($properties); die;
        return view('frontend.filter_templates.filter_by_csc', compact('posts', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    // Search By Service
    public function searchByService($id = null)
    {
        $properties = Property::where(['service_id' => $id])->orderBy('created_at', 'desc')->paginate($this->posts_per_page);
        // $propertyImages = PropertyImages::get();
        // $properties = json_decode(json_encode($properties));
        // echo "<pre>"; print_r($properties); die;
        $property_count = Property::where(['service_id' => $id])->count();



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

        // if (!empty($properties)) {
        //     $contRow = count($properties);
        //     // echo "<pre>"; print_r($contRow); die;
        // } else {
        //     $contRow = 0;
        // }

        $service_metaname = Services::where('id', $id)->first();

        $meta_title = $service_metaname->service_name." Properties | India Property Clinic | IPC";
        $meta_description = "India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";

        return view('frontend.filter_templates.filter_by_service')->with(compact('properties', 'city', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords', 'property_count'));
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
            if(!empty($data['amenity'])){
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            }else{
                $amenity = '';
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
                        'image_size' => '7.5',
                        'property_id' => $id
                    ]);
                }
            }

            // Update Property Details
            Property::where(['id' => $id])->update([
                'property_name' => $data['property_name'], 'property_url' => $data['slug'], 'service_id' => $data['property_for'], 'property_type_id' => $data['property_type'], 'property_price' => $data['property_price'], 'description' => $data['description'], 'featured' => $feature, 'commercial' => $commercial, 'amenities'=>$amenity,
                'map_pass' => $data['map_passed'], 'open_sides' => $data['open_sides'], 'parea' => $data['property_area'], 'widthroad' => $data['width_road_facing'], 'furnish_type' => $data['furnish_type'], 'floorno' => $data['floor_no'], 'total_floors' => $data['total_floors'], 'apple_trees' => $data['trees'], 'transaction_type' => $data['transection_type'], 'construction_status' => $data['construction_status'],
                'bedrooms' => $data['bedrooms'], 'bathrooms' => $data['bathrooms'], 'balconies' => $data['balconies'], 'p_washrooms' => $data['p_washroom'], 'cafeteria' => $data['cafeteria'], 'road_facing' => $data['roadfacing'], 'c_shop' => $data['corner_shop'], 'wall_made' => $data['boundrywall'], 'p_showroom' => $data['pshowroom'], 'property_age' => $data['property_age'],
                'address1' => $data['property_address1'], 'address2' => $data['property_address2'], 'locality' => $data['locality'], 'country' => $data['country'], 'state' => $data['state'], 'city' => $data['city'], 'zipcode' => $data['zipcode'], 'add_by' => $add_by, 'builder' => $data['builder'], 'agent' => $data['agent']
            ]);

            return redirect('/admin/properties')->with('flash_message_success', 'Property Updated Successfulley');
        }

        // Get Properties
        $properties = Property::where(['id' => $id])->first();
        $properties = json_decode(json_encode($properties));
        // Get Property Images
        $propertyImage = PropertyImages::where(['property_id' => $id])->get();

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
        $amenities = Amenity::where('status', 1)->orderBy('name', 'asc')->get();
        // echo "<pre>"; print_r($propertyImage); die;
        return view('admin.property.edit_property', compact('properties', 'propertyImage', 'getBuilder', 'getAgent', 'servicetype', 'propertytype', 'countryname', 'phonecode', 'propertyfor_dropdown', 'propertytype_dropdown', 'builder_dropdown', 'agent_dropdown', 'country_dropdown', 'state_dropdown', 'city_dropdown', 'amenities'));
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

    // Creating unique Slug
    public function checkListSlug(Request $request)
    {
        $slug = SlugService::createSlug(Property::class, 'property_url', $request->property_name, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }

    // List Property by New User
    public function listProperty(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();

            $email = $data['email'];
            $user_count = User::where('email', $email)->count();

            $property_code = 'IPC'.rand(00001, 999999999);

            // echo "<pre>"; print_r($user_count); die;

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

            if (empty($data['featured'])) {
                $feature = 0;
            } else {
                $feature = 1;
            }
            if (empty($data['commercial'])) {
                $commercial = 0;
            } else {
                $commercial = 1;
            }

            if($user_count > 0)
            {
                $user_data = User::where('email', $email)->first();
                $user_id = $user_data['id'];
                
                // echo "<pre>"; print_r($property_code); die;

                $value = Property::create([
                    'property_name'         => $data['property_name'],
                    'property_url'          => $data['slug'],
                    'property_type_id'      => $property_type,
                    'property_code'         => $property_code,
                    'property_price'        => $data['property_price'],
                    'description'           => $data['description'],
                    'featured'              => $feature,
                    'commercial'            => $commercial,
                    'map_pass'              => $data['map_passed'],
                    'open_sides'            => $data['open_sides'],
                    'parea'                 => $data['property_area'],
                    'furnish_type'          => $data['furnish_type'],
                    'floorno'               => $data['floor_no'],
                    'total_floors'          => $data['total_floors'],
                    'apple_trees'           => $data['trees'],
                    'parea'                 => $data['property_area'],
                    'transaction_type'      => $data['transection_type'],
                    'construction_status'   => $data['construnction_status'],
                    'bedrooms'              => $data['bedrooms'],
                    'bathrooms'             => $data['bathrooms'],
                    'balconies'             => $data['balconies'],
                    'p_washrooms'           => $data['p_washroom'],
                    'cafeteria'             => $data['cafeteria'],
                    'p_showroom'            => $data['pshowroom'],
                    'property_age'          => $data['property_age'],
                    'plotno'                => $data['houseno'],
                    'locality'              => $data['locality'],
                    'country'               => $data['country'],
                    'state'                 => $data['state'],
                    'city'                  => $data['city'],
                    'zipcode'               => $data['zipcode'],
                    'add_by'                => $user_id,
                    'service_id'            => $property_for,
                ]);
    
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
                return redirect('/list-property/thank-you')->with('flash_thanx_message', '<h2>Thank you!</h2> <p>Property Listed Successfully! We will give you a call in the next 1 to 2 business days.</p>');
            }else{

                // Add User with Property
                if (!empty($data['name'])) {
                    $user = User::create([
                        'first_name'    => $data['name'],
                        'email'         => $data['email'],
                        'phonecode'     => $data['phonecode'],
                        'phone'         => $data['phone'],
                        'usertype'      => $data['user_type'],
                    ]);
                }

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'phone'=>$data['phone'], 'phonecode'=>$data['phonecode'], 'name' => $data['name'], 'property_url'=>$data['slug'], 'property_name'=>$data['property_name'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.user_register_list_property', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('IPC | Generate account password with India Property Clinic');
                });

                // echo "<pre>"; print_r($data); die;

                $value = Property::create([
                    'property_name'         => $data['property_name'],
                    'property_url'          => $data['slug'],
                    'property_type_id'      => $property_type,
                    'property_code'         => $property_code,
                    'property_price'        => $data['property_price'],
                    'description'           => $data['description'],
                    'featured'              => $feature,
                    'commercial'            => $commercial,
                    'map_pass'              => $data['map_passed'],
                    'open_sides'            => $data['open_sides'],
                    'parea'                 => $data['property_area'],
                    'furnish_type'          => $data['furnish_type'],
                    'floorno'               => $data['floor_no'],
                    'total_floors'          => $data['total_floors'],
                    'apple_trees'           => $data['trees'],
                    'parea'                 => $data['property_area'],
                    'transaction_type'      => $data['transection_type'],
                    'construction_status'   => $data['construnction_status'],
                    'bedrooms'              => $data['bedrooms'],
                    'bathrooms'             => $data['bathrooms'],
                    'balconies'             => $data['balconies'],
                    'p_washrooms'           => $data['p_washroom'],
                    'cafeteria'             => $data['cafeteria'],
                    'p_showroom'            => $data['pshowroom'],
                    'property_age'          => $data['property_age'],
                    'plotno'                => $data['houseno'],
                    'locality'              => $data['locality'],
                    'country'               => $data['country'],
                    'state'                 => $data['state'],
                    'city'                  => $data['city'],
                    'zipcode'               => $data['zipcode'],
                    'add_by'                => $user->id,
                    'service_id'            => $property_for,
                ]);

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

                return redirect('/list-property/thank-you')->with('flash_thanx_message', '<h2>Thank you!</h2> <p>Property Listed Successfully! <br>Please check your Email to generate Login Password and activate your Account. We will give you a call in the next 1 to 2 business days.</p>');

            }
        }

        $phonecode = Country::get();

        return view('frontend.list_property', compact('phonecode'));
    }

    // Thank you page
    public function thankYou()
    {
        return view('frontend.templates.thank_you');
    }

    // // Add User from Add Property Page
    // public function addNewPropertyUser(Request $request)
    // {
    //     $data = $request->all();
    //     echo "<pre>"; print_r($data); die;

    //     return redirect()->back();
    // }

}
