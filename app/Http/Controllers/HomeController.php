<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
Use DB;
use App\Services;
use App\Cities;
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
        $footerProperties = Property::orderBy('created_at', 'desc')->limit(2)->get();
        $propertyImages = PropertyImages::get();
        $propertyType = PropertyTypes::get();
        $otherServices = OtherServices::get();
        $properties = json_decode(json_encode($properties));
        $footerProperties = json_decode(json_encode($footerProperties));

        foreach($properties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $properties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $properties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $properties[$key]->city_name = $city->name;
        }

        foreach($featureProperty as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $featureProperty[$key]->service_name = $service_name->service_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $featureProperty[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $featureProperty[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $featureProperty[$key]->city_name = $city->name;
        }

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $footerProperties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $footerProperties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $footerProperties[$key]->city_name = $city->name;
        }

        $services = Services::where(['status'=>1])->get();
        $continents = DB::table('continents')->get();
        $countries = DB::table('countries')->get();
        // echo "<pre>"; print_r($properties); die;

        return view('home')->with(compact('properties', 'propertyImages', 'footerProperties', 'featureProperty', 'otherServices', 'services', 'propertyType', 'continents', 'countries'));

    }

    // View All Properties
    public function viewAll()
    {
        $properties = Property::orderBy('id', 'asc')->get();
        $posts = Property::paginate($this->posts_per_page);
        $footerProperties = Property::orderBy('created_at', 'desc')->limit(2)->get();
        $propertyImages = PropertyImages::get();
        $otherServices = OtherServices::get();
        $properties = json_decode(json_encode($properties));
        $footerProperties = json_decode(json_encode($footerProperties));
        

        foreach($posts as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $posts[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $posts[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $posts[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $posts[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $posts[$key]->city_name = $city->name;
        }

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $footerProperties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $footerProperties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $footerProperties[$key]->city_name = $city->name;
        }
        
        if(!empty($properties)){
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        }
        return view('frontend.viewall_properties', compact('properties', 'propertyImages', 'otherServices', 'footerProperties', 'contRow', 'posts'));
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
        $footerProperties = Property::orderBy('created_at', 'desc')->limit(2)->get();
        $propertyImages = PropertyImages::get();
        $properties = json_decode(json_encode($properties));
        $footerProperties = json_decode(json_encode($footerProperties));

        foreach($properties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $properties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $properties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $properties[$key]->state_name = $state->name;
            $cityname = DB::table('cities')->where(['id'=>$val->city])->first();
            $properties[$key]->city_name = $cityname->name;
        }

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            // $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $footerProperties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $footerProperties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $footerProperties[$key]->city_name = $city->name;
        }

        if(!empty($properties)){
            $contRow = count($properties);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contRow = 0;
        }
        return view('frontend.filter_templates.filter_by_city')->with(compact('properties', 'propertyImages', 'footerProperties', 'contRow', 'state',));
        }
    }

}
