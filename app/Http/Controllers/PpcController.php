<?php

namespace App\Http\Controllers;

use Image;
use App\State;
use App\Cities;
use App\PpcPage;
use App\Country;
use App\PpcQuery;
use App\OtherServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PpcController extends Controller
{
    // Add New PPC Page
    public function addPpcPage(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Repair Service image/icon
            if ($request->hasFile('banner_image')) {
                $image_tmp = Input::file('banner_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'IPC_Page_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/ppc_images/large/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->save($large_image_path);

                    // Store image in Services folder
                    // $rservices->service_image = $filename;
                }
            }

            PpcPage::create([
                'title'             => $data['title'],
                'url'               => $data['slug'],
                'ppc_type'          => $data['ppc_type'],
                'banner_content'    => $data['banner_content'],
                'description'       => $data['description'],
                'phone'             => $data['phone'],
                'email'             => $data['email'],
                'template_design'   => $data['template_design'],
                'main_service'      => $data['main_service'],
                // 'sub_service'       => $data['sub_service'],
                // 'subs_service'      => $data['subs_service'],
                'status'            => $data['status'],
                'country'           => $data['country'],
                'state'             => $data['state'],
                'city'              => $data['city'],
                'banner_image'      => $filename,
                'meta_title'        => $data['meta_title'],
                'meta_description'  => $data['meta_description'],
                'meta_keywords'     => $data['meta_keywords'],
                'index_status'      => $data['index_status'],
            ]);

            return redirect()->back()->with('flash_message_success', 'Page Created!');
        }

        $county_list = Country::orderBy('name', 'asc')->get();
        $homeServices = OtherServices::where('parent_id', 0)->orderBy('service_name', 'asc')->get();

        return view('admin.ppc_pages.new_ppc_page', compact('homeServices', 'county_list'));
    }

    // View All PPC Pages
    public function returnPpcPages()
    {
        $ppcPages = PpcPage::orderBy('created_at', 'desc')->get();
        $ppcPages = json_decode(json_encode($ppcPages));
        // echo "<pre>"; print_r($ppcPages); die;

        foreach($ppcPages as $key => $val)
        {
            $homeServiceCount = OtherServices::where('id', $val->main_service)->count();
            if($homeServiceCount > 0){
                $homeService = OtherServices::where('id', $val->main_service)->first();
                $ppcPages[$key]->main_service = $homeService->service_name;
            }
            $countryCount = Country::where('iso2', $val->country)->count();
            if($countryCount > 0){
                $country = Country::where('iso2', $val->country)->first();
                $ppcPages[$key]->country = $country->name;
            }
            $stateCount = State::where('id', $val->state)->count();
            if($stateCount > 0){
                $state = State::where('id', $val->state)->first();
                $ppcPages[$key]->state = $state->name;
            }
            $cityCount = Cities::where('id', $val->city)->count();
            if($cityCount > 0){
                $city = Cities::where('id', $val->city)->first();
                $ppcPages[$key]->city = $city->name;
            }
            if($val->ppc_type == 1){
                $ppcPages[$key]->ppc_type = 'Home Service';
            }
        }

        // echo "<pre>"; print_r($ppcPages); die;   

        return view('admin.ppc_pages.get_ppc_pages', compact('ppcPages'));
    }

    // Edit PPC Pages
    public function editPpcPage(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Featured Banner
            if($request->hasFile('banner_image')){
                $image_tmp = Input::file('banner_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'IPC_PPC_PAGE_'.rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/ppc_images/large/'.$filename;
                    // Resize image
                    Image::make($image_tmp)->resize(1920, 500)->save($large_image_path);

                    // Store image in Services folder
                    // $page_data->image = $filename;
                }
            }else {
                $filename = $data['current_image'];
            }

            PpcPage::where('id',$id)->update(['title'=>$data['title'],'url'=> $data['slug'],'ppc_type'=> $data['ppc_type'],'banner_content'=> $data['banner_content'],'description'=> $data['description'],
            'phone'=> $data['phone'],'email'=> $data['email'],'template_design'=> $data['template_design'],'main_service'=> $data['main_service'],'status'=> $data['status'],'country'=> $data['country'],
            'state'=> $data['state'],'city'=> $data['city'],'banner_image'=> $filename,'meta_title'=> $data['meta_title'],'meta_description'=> $data['meta_description'],'meta_keywords'=> $data['meta_keywords'],
            'index_status'=> $data['index_status']]);

            return redirect()->back()->with('flash_message_success', 'Page Updated!');
        }

        $ppcPageData = PpcPage::where('id', $id)->first();
        $statename = State::where(['country' => $ppcPageData->country])->get();
        $cityname = Cities::where(['state_id' => $ppcPageData->state])->get();

        // Select State Name
        $state_dropdown = "<option selected value=''>Select State</option>";
        foreach ($statename as $sname) {
            if ($sname->id == $ppcPageData->state) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $state_dropdown .= "<option value='" . $sname->id . "' " . $selected . ">" . $sname->name . "</option>";
        }

        // Select City Name
        $city_dropdown = "<option selected value=''>Select City</option>";
        foreach ($cityname as $cname) {
            if ($cname->id == $ppcPageData->city) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $city_dropdown .= "<option value='" . $cname->id . "' " . $selected . ">" . $cname->name . "</option>";
        }

        $county_list = Country::orderBy('name', 'asc')->get();
        $homeServices = OtherServices::where('parent_id', 0)->orderBy('service_name', 'asc')->get();

        return view('admin.ppc_pages.edit_ppc_page', compact('ppcPageData','county_list','homeServices','state_dropdown','city_dropdown'));
    }

    // PPC Single Pages
    public function ppcPages(Request $request, $url=null)
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

        $ppcPageData = PpcPage::where('url', $url)->get();

        $meta_title = $ppcPageData[0]['meta_title'];
        $meta_description = $ppcPageData[0]['meta_description'];
        $meta_keywords = $ppcPageData[0]['meta_keywords'];
        $index_status = $ppcPageData[0]['index_status'];
        // echo "<pre>"; print_r($meta_title); die;

        if($ppcPageData[0]['template_design'] == 1){
            return view('frontend.ppc_pages.basic_template', compact('ppcPageData','meta_title','meta_description','meta_keywords','index_status'));
        }
    }

    // Creating unique Slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(PpcPage::class, 'url', $request->title, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }

    // Show PPC Query
    public function returnPpcQuery()
    {
        $ppcQuery = PpcQuery::orderBy('created_at', 'desc')->get();
        $ppcQuery = json_decode(json_encode($ppcQuery));

        foreach($ppcQuery as $key => $val)
        {
            $homeServiceCount = OtherServices::where('id', $val->main_service)->count();
            if($homeServiceCount > 0){
                $homeService = OtherServices::where('id', $val->main_service)->first();
                $ppcQuery[$key]->main_service = $homeService->service_name;
            }
            $homeSubServiceCount = OtherServices::where('id', $val->sub_service)->count();
            if($homeSubServiceCount > 0){
                $homeSubService = OtherServices::where('id', $val->sub_service)->first();
                $ppcQuery[$key]->sub_service = $homeSubService->service_name;
            }
            $homeSubsServiceCount = OtherServices::where('id', $val->subs_service)->count();
            if($homeSubsServiceCount > 0){
                $homeSubsService = OtherServices::where('id', $val->subs_service)->first();
                $ppcQuery[$key]->subs_service = $homeSubsService->service_name;
            }
            $countryCount = Country::where('iso2', $val->country)->count();
            if($countryCount > 0){
                $country = Country::where('iso2', $val->country)->first();
                $ppcQuery[$key]->country = $country->name;
            }
            $stateCount = State::where('id', $val->state)->count();
            if($stateCount > 0){
                $state = State::where('id', $val->state)->first();
                $ppcQuery[$key]->state = $state->name;
            }
            $cityCount = Cities::where('id', $val->city)->count();
            if($cityCount > 0){
                $city = Cities::where('id', $val->city)->first();
                $ppcQuery[$key]->city = $city->name;
            }
        }

        return view('admin.queries.ppc_query', compact('ppcQuery'));
    }
}
