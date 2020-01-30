<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\Page;
use App\State;
use App\Cities;
use App\PpcQuery;
use App\Country;
use App\Property;
use App\Services;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;


class PageController extends Controller
{
    protected $posts_per_page = 12;
    // Add New CMS Pages
    public function newPage(Request $request)
    {
        if ($request->isMethod('post')) {
            $add_by = Auth::user()->id;
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Repair Service image/icon
            if ($request->hasFile('feature_image')) {
                $image_tmp = Input::file('feature_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'IPC_Page_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/page_images/large/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->resize(1280, 720)->save($large_image_path);

                    // Store image in Services folder
                    // $rservices->service_image = $filename;
                }
            }

            if(!empty($filename)){
                $filename = $filename;
            }else{
                $filename = '';
            }

            Page::create([
                'title'             => $data['page_title'],
                'url'               => $data['slug'],
                'content'           => $data['description'],
                'page_type'         => $data['page_type'],
                'template'          => $data['template'],
                'status'            => $data['page_status'],
                'add_by'            => $add_by,
                'image'             => $filename,
                'country'           => $data['country_prop'],
                'state'             => $data['state_prop'],
                'city'              => $data['city_prop'],
                'property_for'      => $data['prop_for'],
                'meta_title'        => $data['meta_title'],
                'meta_description'  => $data['meta_description'],
                'meta_keywords'     => $data['meta_keywords'],
                'canonical_url'     => $data['canonical_url'],
            ]);

            return redirect()->back()->with('flash_message_success', 'Page Published Successfully!');
        }
        return view('admin.pages.new_page');
    }

    // View Single Page
    public function singlePage(Request $request, $url)
    {
        $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $data = Page::where('url', $url)->get();
        $data = json_decode(json_encode($data), true);
        // echo "<pre>"; print_r($data); die;

        if (!empty($data)) {


            if ($data[0]['page_type'] == 1) {
                $data = json_decode(json_encode($data));

                $pdata = json_decode(json_encode($data),true);

                $meta_title = $pdata[0]['title']." | ".config('app.name');
                $meta_description = str_limit(strip_tags($pdata[0]['content']), $limit=200);
                $meta_keywords = "Sale or Rent Property in $arr_ip->country, Sale or Rent Property in $arr_ip->state_name, Sale or Rent Property in $arr_ip->city, Home Services in $arr_ip->city, Home Services in $arr_ip->state_name, Repair Services in $arr_ip->city, Repair Services in $arr_ip->state_name";
                $canonical_url = config('app.url')."/".$pdata[0]['url'];

                // echo "<pre>"; print_r($meta_title); die;

                return view('frontend.pages.templates.'.$pdata[0]['template'], compact('data','meta_title','meta_description','meta_keywords','canonical_url'));

            } elseif ($data[0]['page_type'] == 2) {

                $service_id = $data[0]['service_id'];

                if ($data[0]['property_for'] == 1) {
                    $country_id = $data[0]['country'];
                    $countryname = Country::where(['iso2' => $country_id])->pluck('name');
                    // echo "<pre>"; print_r($countryname); die;
                    $properties = Property::where(function ($query) use ($country_id) {
                        if (isset($country_id)) {
                            $query->where('country', $country_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->get();
                    $posts = Property::where(function ($query) use ($country_id) {
                        if (isset($country_id)) {
                            $query->where('country', $country_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->paginate($this->posts_per_page);

                    $properties = json_decode(json_encode($properties));
                } elseif ($data[0]['property_for'] == 2) {
                    $state_id = $data[0]['state'];
                    $statename = DB::table('states')->where(['id' => $state_id])->pluck('name');
                    $properties = Property::where(function ($query) use ($state_id) {
                        if (isset($state_id)) {
                            $query->where('state', $state_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->get();
                    $posts = Property::where(function ($query) use ($state_id) {
                        if (isset($state_id)) {
                            $query->where('state', $state_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->paginate($this->posts_per_page);

                    $properties = json_decode(json_encode($properties));
                } elseif ($data[0]['property_for'] == 3) {
                    $city_id = $data[0]['city'];
                    $cityname = DB::table('cities')->where(['id' => $city_id])->pluck('name');
                    $properties = Property::where(function ($query) use ($city_id) {
                        if (isset($city_id)) {
                            $query->where('city', $city_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->get();
                    $posts = Property::where(function ($query) use ($city_id) {
                        if (isset($city_id)) {
                            $query->where('city', $city_id);
                        }
                    })->where(function ($query) use ($service_id) {
                        if (isset($service_id)) {
                            $query->where('service_id', $service_id);
                        }
                    })->paginate($this->posts_per_page);
                    // echo "<pre>"; print_r($posts); die;

                    $properties = json_decode(json_encode($properties));
                }

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
                } else {
                    $contRow = 0;
                }
                // echo "<pre>"; print_r($countryname); die;

                if ($data[0]['property_for'] == 1) {
                    $country_metaname = Country::where('iso2', $country_id)->first();
                    $service_metaname = Services::where('id', $service_id)->first();
                    $ctry_metaname = Country::where('iso2', $data[0]['country'])->first();

                    $page_title = $data[0]['title'];
                    $meta_title = $data[0]['title']." | India Property Clinic | IPC";
                    $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name.";
                    $meta_keywords = "Property for sale in $ctry_metaname->name, India Property Clinic, Property Listing, Repair Services, Home Services";
                    $canonical_url = config('app.url')."/".$data[0]['url'];
                    $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $country_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $country_metaname->name registered with us.";

                    return view('frontend.filter_templates.filter_by_csc', compact('contRow', 'countryname', 'posts', 'countrycount', 'meta_title', 'meta_description', 'meta_keywords', 'info_description','canonical_url','page_title'));
                } elseif ($data[0]['property_for'] == 2) {
                    $state_metaname = State::where('id', $state_id)->first();
                    $service_metaname = Services::where('id', $service_id)->first();

                    $ctry_metaname = Country::where('iso2', $data[0]['country'])->first();
                    $st_name = State::where('id', $data[0]['state'])->first();

                    $page_title = $data[0]['title'];
                    $meta_title = $data[0]['title']." | India Property Clinic | IPC";
                    $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_metaname->name.";
                    $meta_keywords = "Property for Sale in $ctry_metaname->name, Property for Sale in $st_name->name, India Property Clinic, Property Listing, Repair Services, Home Services";
                    $canonical_url = config('app.url')."/".$data[0]['url'];
                    $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $state_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $state_metaname->name registered with us.";

                    return view('frontend.filter_templates.filter_by_csc')->with(compact('posts', 'contRow', 'countrycount', 'statecount', 'citycount', 'statename', 'meta_title', 'meta_description', 'meta_keywords', 'info_description','canonical_url','page_title'));
                } elseif ($data[0]['property_for'] == 3) {
                    $city_metaname = Cities::where('id', $city_id)->first();
                    $service_metaname = Services::where('id', $service_id)->first();

                    $ctry_metaname = Country::where('iso2', $data[0]['country'])->first();
                    $st_name = State::where('id', $data[0]['state'])->first();
                    $ct_name = State::where('id', $data[0]['city'])->first();

                    $page_title = $data[0]['title'];
                    $meta_title = $data[0]['title']." | India Property Clinic | IPC";
                    $meta_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name.";
                    $meta_keywords = "Property for Sale in $ctry_metaname->name, Property for Sale in $st_name->name, Property for Sale in $ct_name->name, India Property Clinic, Property Listing, Repair Services, Home Services";
                    $canonical_url = config('app.url')."/".$data[0]['url'];
                    $info_description = "Here you can find list of Residential and Commercial property for Sale or Rent from $city_metaname->name. If you want to sale your property in this location list your property with us. We have list of property dealers and property consultant from $city_metaname->name registered with us.";

                    return view('frontend.filter_templates.filter_by_csc', compact('posts', 'contRow', 'cityname', 'countrycount', 'statecount', 'citycount', 'meta_title', 'meta_description', 'meta_keywords', 'info_description','canonical_url','page_title'));
                }
            }
        } else {
            return redirect('/');
        }
    }

    // Creating unique Slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Page::class, 'url', $request->page_title, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }
    
    // View All Pages
    public function allPages()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.pages_all', compact('pages'));
    }

    // Disable Page
    public function disablePage($id=null)
    {
        if($id)
        {
            Page::where('id', $id)->update(['status'=>0]);
            return redirect()->back()->with('flash_message_success', 'Page Unpublised Successfully!');
        }
    }

    // Enable Page
    public function enablePage($id=null)
    {
        if($id)
        {
            Page::where('id', $id)->update(['status'=>1]);
            return redirect()->back()->with('flash_message_success', 'Page Published Successfully!');
        }
    }

    // Delete Page
    public function deletePage($id=null)
    {
        if($id)
        {
            Page::where('id', $id)->delete();
            return redirect()->back()->with('flash_message_success', 'Page Deleted Successfully!');
        }
    }
    
    // Edit Page
    public function editPage(Request $request, $id=null)
    {
        $page = Page::where('id', $id)->first();
        $page = json_decode(json_encode($page));

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $page_data = new Page;

            // Upload Featured Banner
            if($request->hasFile('feature_image')){
                $image_tmp = Input::file('feature_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $feature_image = rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/page_images/large/'.$feature_image;
                    // Resize image
                    Image::make($image_tmp)->resize(1920, 500)->save($large_image_path);

                    // Store image in Services folder
                    $page_data->image = $feature_image;
                }
            }else {
                $feature_image = $data['current_image'];
            }

            Page::where('id', $id)->update(['title'=>$data['page_title'], 'url'=>$data['slug'], 'content'=>$data['description'],
                                            'template'=>$data['template'], 'status'=>$data['page_status'], 'country'=>$data['country_prop'],
                                            'state'=>$data['state_prop'], 'city'=>$data['city_prop'], 'property_for'=>$data['prop_for'],
                                            'service_id'=>$data['service_id'], 'image'=>$feature_image]);

            return redirect('/admin/pages')->with('flash_message_success', 'Page Updated Successfully!');
            
        }

        // Country Dropdown
        $countryname = DB::table('countries')->get();
        $country_dropdown = "<option selected value=''>Select Country</option>";
        foreach ($countryname as $cont) {
            if ($cont->iso2 == $page->country) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $country_dropdown .= "<option value='" . $cont->iso2 . "' " . $selected . ">" . $cont->name . "</option>";
        }

        // State Dropdown
        $statename = DB::table('states')->where(['country' => $page->country])->get();
        $state_dropdown = "<option selected value=''>Select State</option>";
        foreach ($statename as $stn) {
            if ($stn->id == $page->state) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $state_dropdown .= "<option value='" . $stn->id . "' " . $selected . ">" . $stn->name . "</option>";
        }

        // City Dropdown
        $cityname = DB::table('cities')->where(['state_id' => $page->state])->get();
        $city_dropdown = "<option selected value=''>Select City</option>";
        foreach ($cityname as $city) {
            if ($city->id == $page->city) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $city_dropdown .= "<option value='" . $city->id . "' " . $selected . ">" . $city->name . "</option>";
        }

        return view('admin.pages.edit_page', compact('page', 'country_dropdown', 'state_dropdown', 'city_dropdown'));
    }
    
    // PPC Pages
    public function ppcPages(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            PpcQuery::create([
                'name'          => $data['full_name'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'main_service'  => $data['main_service'],
                'sub_service'   => $data['sub_service'],
                'subs_service'  => $data['subs_service'],
                'message'       => $data['message'],
                'country'       => $data['country'],
                'state'         => $data['state'],
                'city'          => $data['city'],
            ]);

            return redirect()->back()->with('flash_message_success', 'Request Submited Successfully!');

        }
        return view('frontend.custom_pages.plumbing_services');
    }
}
