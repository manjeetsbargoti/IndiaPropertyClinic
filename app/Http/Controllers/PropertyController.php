<?php

namespace App\Http\Controllers;

use App\Amenity;
use App\Cities;
use App\Country;
use App\Property;
use App\PropertyImages;
use App\PropertyQuery;
use App\PropertyTypes;
use App\Services;
use App\State;
use App\User;
use App\UserType;
use DB;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PropertyController extends Controller
{

    protected $posts_per_page = 21;

    // This is the function for Add New Property by Admin
    public function addProperty(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $property_code = 'IPC' . rand(00001, 999999999);

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
            if (!empty($data['amenity'])) {
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            } else {
                $amenity = '';
            }

            DB::beginTransaction();

            try {
                $user = new User;
                // Add Builder/Agent with Property
                if (!empty($data['first_name'])) {
                    $user->first_name = $data['first_name'];
                    $user->last_name = $data['last_name'];
                    $user->email = $data['email'];
                    $user->password = bcrypt($data['password']);
                    $user->phonecode = $data['phonecode'];
                    $user->phone = $data['phone'];
                    $user->usertype = $data['usertype'];

                    $user->save();
                    // echo "<pre>"; print_r($user); die;
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            } catch (\Exception $e) {
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
                    'property_name' => $data['property_name'],
                    'property_url' => $data['slug'],
                    'property_type_id' => $property_type,
                    'property_code' => $property_code,
                    'property_price' => $data['property_price'],
                    // 'booking_price'         => $data['booking_price'],
                    'description' => $data['description'],
                    'featured' => $feature,
                    'commercial' => $commercial,
                    'amenities' => $amenity,
                    'map_pass' => $data['map_passed'],
                    'open_sides' => $data['open_sides'],
                    'parea' => $data['property_area'],
                    'widthroad' => $data['width_road_facing'],
                    'furnish_type' => $data['furnish_type'],
                    'floorno' => $data['floor_no'],
                    'total_floors' => $data['total_floors'],
                    'apple_trees' => $data['trees'],
                    'parea' => $data['property_area'],
                    // 'pfacing'               => $data['property_facing'],
                    'transaction_type' => $data['transection_type'],
                    'construction_status' => $data['construction_status'],
                    'bedrooms' => $data['bedrooms'],
                    'bathrooms' => $data['bathrooms'],
                    'balconies' => $data['balconies'],
                    'p_washrooms' => $data['p_washroom'],
                    'cafeteria' => $data['cafeteria'],
                    'road_facing' => $data['roadfacing'],
                    'c_shop' => $data['corner_shop'],
                    'wall_made' => $data['boundrywall'],
                    'p_showroom' => $data['pshowroom'],
                    'property_age' => $data['property_age'],
                    // 'plotno'                => $data['plot_no'],
                    'address1' => $data['property_address1'],
                    'address2' => $data['property_address2'],
                    'locality' => $data['locality'],
                    'country' => $data['country'],
                    'state' => $data['state'],
                    'city' => $data['city'],
                    'zipcode' => $data['zipcode'],
                    'add_by' => $add_by,
                    'service_id' => $property_for,
                    'builder' => $builder_id,
                    'agent' => $data['agent'],
                    'meta_title' => $data['meta_title'],
                    'meta_description' => $data['meta_description'],
                    'meta_keywords' => $data['meta_keywords'],
                ]);
            } catch (ValidationException $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            // echo "<pre>"; print_r($value); die;

            // Upload image
            try {
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
            } catch (ValidationException $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            } catch (\Exception $e) {
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
        if (Auth::user()->admin == 1 || Auth::user()->usertype == 'S') {
            $properties = Property::orderBy('created_at', 'desc')->paginate(10);
        } else {
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
            if ($property_agent_count > 0) {
                $property_agent = User::where('id', $val->agent)->first();
                $properties[$key]->agent_fname = $property_agent->first_name;
                $properties[$key]->agent_lname = $property_agent->last_name;
                $properties[$key]->agent_id = $property_agent->id;
            }

            $property_builder_count = User::where('id', $val->builder)->count();
            if ($property_builder_count > 0) {
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
        // if ($propertyCount == 0) {
        //     abort(404);
        // }

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

            $property_type_name = PropertyTypes::where(['property_type_code' => $val->property_type_id])->first();
            $properties[$key]->property_type_name = $property_type_name->property_type;

            $propertyImages_count = PropertyImages::where(['property_id' => $val->id])->count();
            if ($propertyImages_count > 0) {
                $propertyImages = PropertyImages::where(['property_id' => $val->id])->first();
                $properties[$key]->property_image = $propertyImages->image_name;
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
                $properties[$key]->add_by = $addBy->first_name;
                $properties[$key]->status = $addBy->status;
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
        if ($property_l_city_count > 2) {
            $property_on_location = Property::where('city', $p_location->city)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        } elseif ($property_l_city_state > 2) {
            $property_on_location = Property::where('state', $p_location->state)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        } elseif ($property_l_city_country > 0) {
            $property_on_location = Property::where('country', $p_location->country)->where('service_id', $p_location->service_id)->orderBy('created_at', 'desc')->take(8)->get();
        }

        $property = json_decode(json_encode($properties), true);
        // echo "<pre>"; print_r($property); die;

        if (!empty($property[0]['meta_title'])) {
            $meta_title = $property[0]['meta_title'] . " | " . config('app.name');
        } else {
            $meta_title = $property[0]['property_name'] . " | " . config('app.name');
        }

        if (!empty($property[0]['meta_description'])) {
            $meta_description = str_limit(strip_tags($property[0]['meta_description']), $limit = 200);
        } else {
            $meta_description = str_limit(strip_tags($property[0]['description']), $limit = 200);
        }

        if (!empty($property[0]['meta_keywords'])) {
            $meta_keywords = $property[0]['meta_keywords'];
        } else {
            $meta_keywords = $property[0]['property_type_name'] . " for " . $property[0]['service_name'] . " in " . $property[0]['country_name'] . ", " . $property[0]['property_type_name'] . " for " . $property[0]['service_name'] . " in " . $property[0]['state_name'] . ", " . $property[0]['property_type_name'] . " for " . $property[0]['service_name'] . " in " . $property[0]['city_name'] . ", " . $property[0]['property_name'] . ", " . $property[0]['property_type_name'] . " for " . $property[0]['service_name'] . ", " . $property[0]['property_type_name'] . ", " . $property[0]['property_type_name'] . " in " . $property[0]['city_name'];
        }

        if (!empty($property[0]['canonical_url'])) {
            $canonical_url = $property[0]['canonical_url'];
        } else {
            $canonical_url = config('app.url') . "/properties/" . $property[0]['property_url'];
        }

        if (!empty($property[0]['property_image'])) {
            $page_image = config('app.url') . "/images/backend_images/property_images/large" . $property[0]['property_image'];
        }

        // echo "<pre>"; print_r($property); die;

        return view('frontend.view_single_property')->with(compact('properties', 'country_count', 'state_count', 'city_count', 'property_on_location', 'meta_title', 'meta_description', 'meta_keywords', 'canonical_url', 'page_image'));
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
        $page_title = "Properties for Sale in $state_id";
        $meta_title = "Property for Sale in $state_id | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_id.";
        $meta_keywords = "Property for Sale in $state_id, Property in $state_id, India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_id. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $state_id registered with us.";

        return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'contRow', 'countrycount', 'statecount', 'citycount', 'statename', 'meta_title', 'meta_description', 'meta_keywords', 'sid', 'info_description', 'page_title'));
    }

    public function searchByCountry($country_id = null)
    {
        $countryname = DB::table('countries')->where(['iso2' => $country_id])->pluck('name');
        // echo "<pre>"; print_r($countryname); die;
        $ctryid = Country::where('iso2', $country_id)->first();
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
        $page_title = "Properties for Sale in $country_metaname->name";
        $meta_title = "Properties for Sale in $country_metaname->name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name.";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $country_metaname->name registered with us.";

        // echo "<pre>"; print_r($meta_name); die;

        return view('frontend.filter_templates.filter_by_csc', compact('contRow', 'countryname', 'posts', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords', 'ctryid', 'info_description', 'page_title'));
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
        $page_title = "Properties for Sale in $city_metaname->name";
        $meta_title = "Property for Sale in $city_metaname->name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $city_metaname->name registered with us.";

        // echo "<pre>"; print_r($properties); die;
        return view('frontend.filter_templates.filter_by_csc', compact('posts', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords', 'cid', 'info_description', 'page_title'));
    }

    // Search By Service
    public function searchByService($id = null)
    {
        $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $properties = Property::where(['service_id' => $id])->where('country', $arr_ip->iso_code)->orderBy('created_at', 'desc')->paginate($this->posts_per_page);
        // echo "<pre>"; print_r($properties); die;
        $property_count = Property::where(['service_id' => $id])->where('country', $arr_ip->iso_code)->count();

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

        $service_metaname = Services::where('id', $id)->first();

        $meta_title = "Property for $service_metaname->service_name in $arr_ip->country | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for $service_metaname->service_name from $arr_ip->country.";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for $service_metaname->service_name from $arr_ip->country. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $arr_ip->country registered with us.";

        return view('frontend.filter_templates.filter_by_service')->with(compact('properties', 'city', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords', 'property_count', 'info_description'));
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
            if (!empty($data['amenity'])) {
                $amenities = $data['amenity'];
                $amenity = implode(',', $amenities);
            } else {
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
                        'property_id' => $id,
                    ]);
                    // }
                    if (!empty($filename)) {
                        PropertyImages::where(['property_id' => $id])->update(['image_name' => $filename]);
                    }
                }
            } else {
                $propertyimg_count = PropertyImages::where(['property_id' => $id])->count();
                if (empty($propertyimg_count)) {
                    $filename = "default.jpg";
                    PropertyImages::create([
                        'image_name' => $filename,
                        'image_size' => '7.5',
                        'property_id' => $id,
                    ]);
                }
            }

            // Update Property Details
            Property::where(['id' => $id])->update([
                'property_name' => $data['property_name'], 'property_url' => $data['slug'], 'service_id' => $data['property_for'], 'property_type_id' => $data['property_type'], 'property_price' => $data['property_price'], 'description' => $data['description'], 'featured' => $feature, 'commercial' => $commercial, 'amenities' => $amenity,
                'map_pass' => $data['map_passed'], 'open_sides' => $data['open_sides'], 'parea' => $data['property_area'], 'widthroad' => $data['width_road_facing'], 'furnish_type' => $data['furnish_type'], 'floorno' => $data['floor_no'], 'total_floors' => $data['total_floors'], 'apple_trees' => $data['trees'], 'transaction_type' => $data['transection_type'], 'construction_status' => $data['construction_status'],
                'bedrooms' => $data['bedrooms'], 'bathrooms' => $data['bathrooms'], 'balconies' => $data['balconies'], 'p_washrooms' => $data['p_washroom'], 'cafeteria' => $data['cafeteria'], 'road_facing' => $data['roadfacing'], 'c_shop' => $data['corner_shop'], 'wall_made' => $data['boundrywall'], 'p_showroom' => $data['pshowroom'], 'property_age' => $data['property_age'],
                'address1' => $data['property_address1'], 'address2' => $data['property_address2'], 'locality' => $data['locality'], 'country' => $data['country'], 'state' => $data['state'], 'city' => $data['city'], 'zipcode' => $data['zipcode'], 'add_by' => $add_by, 'builder' => $data['builder'], 'agent' => $data['agent'],
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
        $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);

        if ($request->isMethod('post')) {
            $data = $request->all();

            $email = $data['email'];
            $user_count = User::where('email', $email)->count();

            $property_code = 'IPC' . rand(00001, 999999999);

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

            if ($user_count > 0) {
                $user_data = User::where('email', $email)->first();
                $user_id = $user_data['id'];

                // echo "<pre>"; print_r($property_code); die;

                $value = Property::create([
                    'property_name' => $data['property_name'],
                    'property_url' => $data['slug'],
                    'property_type_id' => $property_type,
                    'property_code' => $property_code,
                    'property_price' => $data['property_price'],
                    'description' => $data['description'],
                    'featured' => $feature,
                    'commercial' => $commercial,
                    'map_pass' => $data['map_passed'],
                    'open_sides' => $data['open_sides'],
                    'parea' => $data['property_area'],
                    'furnish_type' => $data['furnish_type'],
                    'floorno' => $data['floor_no'],
                    'total_floors' => $data['total_floors'],
                    'apple_trees' => $data['trees'],
                    'parea' => $data['property_area'],
                    'transaction_type' => $data['transection_type'],
                    'construction_status' => $data['construnction_status'],
                    'bedrooms' => $data['bedrooms'],
                    'bathrooms' => $data['bathrooms'],
                    'balconies' => $data['balconies'],
                    'p_washrooms' => $data['p_washroom'],
                    'cafeteria' => $data['cafeteria'],
                    'p_showroom' => $data['pshowroom'],
                    'property_age' => $data['property_age'],
                    'plotno' => $data['houseno'],
                    'locality' => $data['locality'],
                    'country' => $data['country'],
                    'state' => $data['state'],
                    'city' => $data['city'],
                    'zipcode' => $data['zipcode'],
                    'add_by' => $user_id,
                    'service_id' => $property_for,
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
            } else {

                // Add User with Property
                if (!empty($data['name'])) {
                    $user = User::create([
                        'first_name' => $data['name'],
                        'email' => $data['email'],
                        'phonecode' => $data['phonecode'],
                        'phone' => $data['phone'],
                        'usertype' => $data['user_type'],
                    ]);
                }

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'phone' => $data['phone'], 'phonecode' => $data['phonecode'], 'name' => $data['name'], 'property_url' => $data['slug'], 'property_name' => $data['property_name'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.user_register_list_property', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('IPC | Generate account password with India Property Clinic');
                });

                // echo "<pre>"; print_r($data); die;

                $value = Property::create([
                    'property_name' => $data['property_name'],
                    'property_url' => $data['slug'],
                    'property_type_id' => $property_type,
                    'property_code' => $property_code,
                    'property_price' => $data['property_price'],
                    'description' => $data['description'],
                    'featured' => $feature,
                    'commercial' => $commercial,
                    'map_pass' => $data['map_passed'],
                    'open_sides' => $data['open_sides'],
                    'parea' => $data['property_area'],
                    'furnish_type' => $data['furnish_type'],
                    'floorno' => $data['floor_no'],
                    'total_floors' => $data['total_floors'],
                    'apple_trees' => $data['trees'],
                    'parea' => $data['property_area'],
                    'transaction_type' => $data['transection_type'],
                    'construction_status' => $data['construnction_status'],
                    'bedrooms' => $data['bedrooms'],
                    'bathrooms' => $data['bathrooms'],
                    'balconies' => $data['balconies'],
                    'p_washrooms' => $data['p_washroom'],
                    'cafeteria' => $data['cafeteria'],
                    'p_showroom' => $data['pshowroom'],
                    'property_age' => $data['property_age'],
                    'plotno' => $data['houseno'],
                    'locality' => $data['locality'],
                    'country' => $data['country'],
                    'state' => $data['state'],
                    'city' => $data['city'],
                    'zipcode' => $data['zipcode'],
                    'add_by' => $user->id,
                    'service_id' => $property_for,
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

        $page_title = "Property for Sale in $arr_ip->state_name";
        $meta_title = "List Your Property | India Property Clinic";
        $meta_description = "List your property with India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "Sale or Rent Property in $arr_ip->country, Sale or Rent Property in $arr_ip->state_name, Sale or Rent Property in $arr_ip->city, Home Services in $arr_ip->city, Home Services in $arr_ip->state_name, Repair Services in $arr_ip->city, Repair Services in $arr_ip->state_name";

        return view('frontend.list_property', compact('phonecode', 'meta_title', 'meta_description', 'meta_keywords', 'page_title'));
    }

    // Thank you page
    public function thankYou()
    {
        return view('frontend.templates.thank_you');
    }

    // Add Dubai Properties
    public function dubaiProperty()
    {
        $data = DB::table('dubai_properties')->where('city', 'Dubai')->take(100)->get();
        $data = json_decode(json_encode($data));

        foreach ($data as $key => $val) {
            // Maping Property Offering Type
            if ($val->offering_type == 'sale') {
                $data[$key]->offering_type = 4;
            } elseif ($val->offering_type == 'rent') {
                $data[$key]->offering_type = 3;
            }

            // Creating Property URL
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $val->pro_title);
            $data[$key]->slug = $slug;

            // Maping Property Type name
            if ($val->t_name == 'Apartment') {
                $data[$key]->t_name = 1004;
            } elseif ($val->t_name == 'Office Space') {
                $data[$key]->t_name = 1009;
            } elseif ($val->t_name == 'Townhouse') {
                $data[$key]->t_name = 1002;
            } elseif ($val->t_name == 'Villa') {
                $data[$key]->t_name = 1005;
            } elseif ($val->t_name == 'Penthouse') {
                $data[$key]->t_name = 1006;
            } elseif ($val->t_name == 'Land' && $val->t_category == 'commercial') {
                $data[$key]->t_name = 1014;
            } elseif ($val->t_name == 'Land' && $val->t_category == 'residential') {
                $data[$key]->t_name = 1017;
            } elseif ($val->t_name == 'Shop') {
                $data[$key]->t_name = 1010;
            } elseif ($val->t_name == 'Warehouse') {
                $data[$key]->t_name = 1013;
            } elseif ($val->t_name == 'Duplex') {
                $data[$key]->t_name = 1025;
            } elseif ($val->t_name == 'Labor Camp') {
                $data[$key]->t_name = 1026;
            } elseif ($val->t_name == 'Retail') {
                $data[$key]->t_name = 1011;
            } elseif ($val->t_name == 'Whole Building') {
                $data[$key]->t_name = 1003;
            }

            // Maping Furnished Type
            if ($val->furnished == 'unfurnished') {
                $data[$key]->furnished = 'U';
            } elseif ($val->furnished == 'furnished') {
                $data[$key]->furnished = 'F';
            } elseif ($val->furnished == 'semi-furnished') {
                $data[$key]->furnished = 'S';
            }

            // Maping Category
            if ($val->t_category == 'residential') {
                $data[$key]->t_category = 0;
            } else {
                $data[$key]->t_category = 1;
            }

            // Maping Construction Type
            if ($val->status == 'available') {
                $data[$key]->construction_status = 'Ready to Move';
            }

            // Maping Map Passed
            if ($val->state == 'approved') {
                $data[$key]->map_passed = 1;
            }

            // Location Maping
            $state = State::where('name', $val->city)->first();
            $city = Cities::where('name', 'like', '%' . $val->community . '%')->first();
            $city = json_decode(json_encode($city), true);
            // echo "<pre>"; print_r($city);die;
            $data[$key]->state_id = $city['state_id'];
            $data[$key]->country = $state->country;
            $data[$key]->city = $city['id'];

            // Amenities Maping
            $ame = array();
            $i = 0;
            foreach (explode(',', $val->amenities_name) as $am) {
                $amenity = Amenity::where('name', 'like', '%' . $am . '%')->get();
                $amenity = json_decode(json_encode($amenity), true);
                // $amenities_name = $amenity->amenity_code;
                // $data[$key]->amenities_name = $amenity['amenity_code'];
                foreach ($amenity as $amty) {
                    $amenities_name = $amty['amenity_code'];
                    if (!empty($amty['amenity_code'])) {
                        $amenities_name = $amty['amenity_code'];
                        $ame[$i] = $amenities_name;
                        $i++;
                    } else {
                        $amenities_name = '';
                    }
                }
                $amenities_name = implode(',', $ame);
                $data[$key]->amenities_name = $amenities_name;
            }

            // $data = json_decode(json_encode($data), true);
            echo "<pre>";
            print_r($data);die;

        }

        foreach ($data as $da) {
            DB::beginTransaction();
            try {
                // insert property to database
                $value = Property::create([
                    'property_name' => $da->pro_title,
                    'property_url' => $da->slug,
                    'property_type_id' => $da->t_name,
                    'property_code' => $da->reference,
                    'property_price' => $da->price_value,
                    'description' => $da->pro_description,
                    'commercial' => $da->t_category,
                    'amenities' => $da->amenities_name,
                    'map_pass' => $da->map_passed,
                    'furnish_type' => $da->furnished,
                    'parea' => $da->plot_size,
                    'construction_status' => $da->construction_status,
                    'bedrooms' => $da->bedrooms,
                    'bathrooms' => $da->bathrooms,
                    'address1' => $da->sub_community,
                    'address2' => $da->tower,
                    'locality' => $da->community,
                    'country' => $da->country,
                    'state' => $da->state_id,
                    'city' => $da->city,
                    'add_by' => '1',
                    'service_id' => $da->offering_type,
                    'agent' => '1',
                    'meta_title' => $da->pro_title,
                ]);
            } catch (ValidationException $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            try {
                // Dounloading Property images to folder and saving name to database
                foreach ($data as $key => $val) {
                    $image_full = explode(',', $val->images_flink);
                    // $array_len = count($image_full);
                    for ($j = 0; $j < 5; $j++) {
                        $filename = basename($image_full[$j]);
                        $large_image_path = public_path('images/backend_images/property_images/large/' . $filename);
                        Image::make($image_full[$j])->save(public_path('/images/dubai_images/' . $filename));

                        // Store image in property folder
                        $propertyimage = PropertyImages::create([
                            'image_name' => $filename,
                            // 'image_size' => $image_size,
                            'property_id' => $value->id,
                        ]);
                    }
                }
            } catch (ValidationException $e) {
                DB::rollback();
                return Redirect()->back()->withErrors($e->getErrors())->withInput();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

            DB::commit();
        }
        // echo "<pre>"; print_r($data);die;
        echo "Success!";
    }

    // Property search by country name
    public function searchByCountryName($country_name = null)
    {
        $country_count = DB::table('countries')->where(['name' => $country_name])->count();
        if ($country_count > 0) {
            $country_name = $country_name;
        } else {
            $country_name = str_replace('-', ' ', $country_name);
        }
        // echo "<pre>"; print_r($country_name); die;
        $countryname = DB::table('countries')->where(['name' => $country_name])->pluck('name');
        // echo "<pre>"; print_r($countryname); die;
        $ctryid = Country::where('name', $country_name)->first();
        // $ctryiso2 = Country::where('name', $country_name)->first();
        $properties = Property::where(['country' => $ctryid->iso2])->get();
        // echo "<pre>"; print_r($properties); die;
        $posts = Property::where(['country' => $ctryid->iso2])->paginate($this->posts_per_page);
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

        $country_metaname = Country::where('name', $country_name)->first();

        $page_title = "Property for Sale in $country_metaname->name";
        $meta_title = "Property for Sale in $country_metaname->name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name.";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $country_metaname->name registered with us.";

        // echo "<pre>"; print_r($meta_name); die;

        return view('frontend.filter_templates.filter_by_csc', compact('contRow', 'countryname', 'posts', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords', 'ctryid', 'info_description', 'page_title'));
    }

    // Search by Property Type and Country
    public function searchByCountryPropertyType($property_types = null, $property_type = null, $country_name = null)
    {

        // echo "<pre>"; print_r($country_name); die;

        $country_count = DB::table('countries')->where(['name' => $country_name])->count();
        if ($country_count > 0) {
            $country_name = $country_name;
        } else {
            $country_name = str_replace('_', ' ', $country_name);
        }
        $property_count = PropertyTypes::where('property_type', $property_types)->count();
        if ($property_count > 0) {
            $property_type_name = $property_types;
        } else {
            $property_type_name = str_replace('_', ' ', $property_types);
        }
        // echo "<pre>"; print_r($property_type_name); die;
        $countryname = DB::table('countries')->where(['name' => $country_name])->pluck('name');
        $property_type_code = PropertyTypes::select('property_type_code')->where('property_type', $property_type_name)->first();
        // echo "<pre>"; print_r($property_type_code); die;
        $ctryid = Country::where('name', $country_name)->first();
        // $ctryiso2 = Country::where('name', $country_name)->first();
        $properties = Property::where(['country' => $ctryid->iso2])->where('property_type_id', $property_type_code->property_type_code)->get();
        // echo "<pre>"; print_r($properties); die;
        $posts = Property::where(['country' => $ctryid->iso2])->where('property_type_id', $property_type_code->property_type_code)->paginate($this->posts_per_page);
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

        $country_metaname = Country::where('name', $country_name)->first();

        $page_title = "$property_type_name for Sale in $country_metaname->name";
        $meta_title = "Property for Sale in $country_metaname->name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name.";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $country_metaname->name registered with us.";

        // echo "<pre>"; print_r($meta_name); die;

        return view('frontend.filter_templates.filter_by_csc', compact('contRow', 'countryname', 'posts', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords', 'ctryid', 'info_description', 'page_title'));
    }

    // Search Property Type and State
    public function searchByStatePropertyType($property_types = null, $property_type = null, $state_name = null)
    {
        // echo "<pre>"; print_r($state_name); die;

        $country_count = DB::table('states')->where(['name' => $state_name])->count();
        if ($country_count > 0) {
            $state_name = $state_name;
        } else {
            $state_name = str_replace('_', ' ', $state_name);
        }
        $property_count = PropertyTypes::where('property_type', $property_types)->count();
        if ($property_count > 0) {
            $property_type_name = $property_types;
        } else {
            $property_type_name = str_replace('_', ' ', $property_types);
        }
        // echo "<pre>"; print_r($state_name);die;
        $statename = DB::table('states')->where(['name' => $state_name])->pluck('name');
        $property_type_code = PropertyTypes::select('property_type_code')->where('property_type', $property_type_name)->first();
        // echo "<pre>"; print_r($statename);die;
        $sid = State::where('name', $state_name)->first();
        $properties = Property::where(['state' => $sid['id']])->where('property_type_id', $property_type_code->property_type_code)->get();
        $posts = Property::where(['state' => $sid['id']])->where('property_type_id', $property_type_code->property_type_code)->paginate($this->posts_per_page);
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

        // $state_metaname = State::where('id', $state_name)->first();
        $page_title = "$property_type_name for Sale in $state_name";
        $meta_title = "Property for Sale in $state_name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_name.";
        $meta_keywords = "Property for Sale in $state_name, Property in $state_name, India Property Clinic, Property Listing, Repair Services, Home Services";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $state_name registered with us.";

        return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'contRow', 'countrycount', 'statecount', 'citycount', 'statename', 'meta_title', 'meta_description', 'meta_keywords', 'sid', 'info_description', 'page_title'));
    }

    // Search Property Type and State
    public function searchByCityPropertyType($property_types = null, $property_type = null, $city_name = null)
    {
        // echo "<pre>"; print_r($city_name); die;

        $country_count = DB::table('states')->where(['name' => $city_name])->count();
        if ($country_count > 0) {
            $city_name = $city_name;
        } else {
            $city_name = str_replace('_', ' ', $city_name);
        }
        $property_count = PropertyTypes::where('property_type', $property_types)->count();
        if ($property_count > 0) {
            $property_type_name = $property_types;
        } else {
            $property_type_name = str_replace('_', ' ', $property_types);
        }
        // echo "<pre>"; print_r($property_type_name);die;

        $cityname = DB::table('cities')->where(['name' => $city_name])->pluck('name');
        $property_type_code = PropertyTypes::select('property_type_code')->where('property_type', $property_type_name)->first();
        // echo "<pre>"; print_r($property_type_code);die;
        $cid = Cities::where('name', $city_name)->first();
        $properties = Property::where(['city' => $cid['id']])->where('property_type_id', $property_type_code->property_type_code)->get();
        $posts = Property::where(['city' => $cid['id']])->where('property_type_id', $property_type_code->property_type_code)->paginate($this->posts_per_page);
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

        $city_metaname = Cities::where('name', $city_name)->first();
        $page_title = "$property_type_name for Sale in $city_metaname->name";
        $meta_title = "$property_type_name for Sale in $city_metaname->name | India Property Clinic | IPC";
        $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name";
        $meta_keywords = "India Property Clinic, Property Listing, Repair Services, Home Services,$property_type_name for Sale in $city_metaname->name";
        $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $city_metaname->name registered with us.";

        // echo "<pre>"; print_r($properties); die;
        return view('frontend.filter_templates.filter_by_csc', compact('posts', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords', 'cid', 'info_description', 'page_title'));
    }

}
