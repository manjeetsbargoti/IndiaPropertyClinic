<?php

namespace App\Http\Controllers;

Use DB;
use Auth;
use Image;
use Session;
use App\User;
use App\Cities;
use App\Services;
use App\Property;
use App\PropertyTypes;
Use App\OtherServices;
Use App\PropertyImages;
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
        $properties = Property::orderBy('id', 'asc')->get();
        $featureProperty = Property::where(['featured'=>1])->get();
        $propertyImages = PropertyImages::get();
        $propertyType = PropertyTypes::get();
        $otherServices = OtherServices::get();
        $properties = json_decode(json_encode($properties));

        foreach($properties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id'=>$val->country])->count();
            if($country_count > 0){
                $country = DB::table('countries')->where(['id'=>$val->country])->first();
                $properties[$key]->country_name = $country->name;
            }
            $state_count = DB::table('states')->where(['id'=>$val->state])->count();
            if($state_count > 0) {
                $state = DB::table('states')->where(['id'=>$val->state])->first();
                $properties[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id'=>$val->city])->count();
            if($city_count){
                $city = DB::table('cities')->where(['id'=>$val->city])->first();
                $properties[$key]->city_name = $city->name;
            }
        }

        foreach($featureProperty as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $featureProperty[$key]->service_name = $service_name->service_name;
            $country_countf = DB::table('countries')->where(['id'=>$val->country])->count();
            if($country_countf > 0){
                $country = DB::table('countries')->where(['id'=>$val->country])->first();
                $featureProperty[$key]->country_name = $country->name;
            }
            $state_countf = DB::table('states')->where(['id'=>$val->state])->count();
            if($state_countf > 0) {
                $state = DB::table('states')->where(['id'=>$val->state])->first();
                $featureProperty[$key]->state_name = $state->name;
            }
            $city_countf = DB::table('cities')->where(['id'=>$val->city])->count();
            if($city_countf){
                $city = DB::table('cities')->where(['id'=>$val->city])->first();
                $featureProperty[$key]->city_name = $city->name;
            }
        }
        if($country_count > 0){
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        // echo "<pre>"; print_r($properties); die;
        if(!empty($state_count)){
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if(!empty($city_count)){
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }

        $dealer = User::where(['usertype'=>'A'])->orWhere(['usertype'=>'B'])->orderBy('created_at', 'desc')->get();
        $dealer = json_decode(json_encode($dealer));

        $services = Services::where(['status'=>1])->get();
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
        $properties = Property::orderBy('created_at', 'desc')->get();
        $posts = Property::orderBy('created_at', 'desc')->paginate($this->posts_per_page);
        $propertyImages = PropertyImages::get();
        $otherServices = OtherServices::get();

        foreach($posts as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $posts[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id'=>$val->country])->count();
            if($country_count > 0)
            {
                $country = DB::table('countries')->where(['id'=>$val->country])->first();
                $posts[$key]->country_name = $country->name;
            }
            $state_count = DB::table('states')->where(['id'=>$val->state])->count();
            if($state_count > 0)
            {
                $state = DB::table('states')->where(['id'=>$val->state])->first();
                $posts[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id'=>$val->city])->count();
            if($city_count > 0)
            {
                $city = DB::table('cities')->where(['id'=>$val->city])->first();
                $posts[$key]->city_name = $city->name;
            }
        }
        if(!empty($country_count)){
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        if(!empty($state_count)){
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if(!empty($city_count)){
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }
        
        if(!empty($properties)){
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        }
        return view('frontend.viewall_properties', compact('properties', 'propertyImages', 'otherServices', 'contRow', 'posts', 'countrycount', 'statecount', 'citycount'));
    }

    // Home Page Search Function Start
    public function search(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('cities')->where('name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="jiodropdown">';
                foreach($data as $row)
                {
                    $flag = '<span class="flag_name">'.$row->id.'</span>';
                    $output .= '<li>'.$row->name.'</li>';
                }
            $output .= '</ul>';
            echo $output;
        }
    }

    // Home Page Search-Result Function Start
    public function searchresult(Request $request )
    {
        $data = $request->all();
        $scityname = rtrim($data['search_text']);
        $scityname = json_decode(json_encode($scityname));
        // echo '<pre>'; print_r($data); die;
        if( empty( $data['search_text']) && empty($data['property_type']) ){
            return redirect()->back()->with('searcherr','Please enter search value');
        }else{
        $city = Cities::where(['name'=> rtrim($data['search_text']) ])->get();
        $city = json_decode(json_encode($city),true);
        
            if(empty($data['property_type'])){
                $r = $city[0];
                $properties = Property::where([ 'city'=> $r['id']])->get();
            }elseif(empty( $data['search_text'])){
                $properties = Property::where([ 'property_type_id'=>$data['property_type']])->get();
            }else{
                $r = $city[0];
                $properties = Property::where([[ 'city','=',$r['id']], [ 'property_type_id', '=', $data['property_type']]])->get();
            }

        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));

        foreach($properties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country_count = DB::table('countries')->where(['id'=>$val->country])->count();
            if($country_count > 0){
                $country = DB::table('countries')->where(['id'=>$val->country])->first();
                $properties[$key]->country_name = $country->name;
            
            }
            $state_count = DB::table('states')->where(['id'=>$val->state])->count();
            if($state_count > 0){
                $state = DB::table('states')->where(['id'=>$val->state])->first();
                $properties[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id'=>$val->city])->count();
            if($city_count > 0){
                $cityname = DB::table('cities')->where(['id'=>$val->city])->first();
                $properties[$key]->city_name = $cityname->name;
            }
        }
        if(!empty($country_count)){
            $countrycount = $country_count;
        } else {
            $countrycount = 0;
        }
        if(!empty($state_count)){
            $statecount = $state_count;
        } else {
            $statecount = 0;
        }
        if(!empty($city_count)){
            $citycount = $city_count;
        } else {
            $citycount = 0;
        }

        if(!empty($properties)){
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contRow = 0;
        }

        // echo "<pre>"; print_r($scityname); die;
        return view('frontend.filter_templates.search_result')->with(compact('properties', 'propertyImages', 'contRow', 'countrycount', 'statecount', 'citycount', 'scityname'));
        }
    }

}
