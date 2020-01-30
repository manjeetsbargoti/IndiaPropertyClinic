<?php

namespace App\Http\Controllers;

use DB;
Use Image;
use App\Cities;
Use App\User;
Use App\Property;
Use App\Services;
use App\OtherServices;
use App\RequestService;
Use App\PropertyImages;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Input;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class RepairServiceController extends Controller
{
    // Add New Repair Services
    public function addRService(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            $rservices = new OtherServices;
            $rservices->service_name    = $data['rservice_name'];
            $rservices->parent_id       = $data['parent_id'];
            $rservices->s_description   = $data['s_description'];
            $rservices->description     = $data['description'];
            $rservices->url             = $data['slug'];
            $rservices->status          = $status;


            // Upload Repair Service image/icon
            if($request->hasFile('rservice_image')){
                $image_tmp = Input::file('rservice_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1, 99999).'.'.$extension;
                    $watermark = Image::make(public_path('/images/frontend_images/images/logo.png'));
                    $large_image_path = 'images/backend_images/repair_service_images/large/'.$filename;
                    // Resize image
                    Image::make($image_tmp)->resize(730, 464)->insert($watermark, 'center', 30, 30)->save($large_image_path);

                    // Store image in Services folder
                    $rservices->service_image = $filename;
                }
            }

            // Upload Repair Service banner
            if($request->hasFile('rservice_banner')){
                $image_tmp = Input::file('rservice_banner');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/repair_service_images/large/'.$filename;

                    // Resize image
                    Image::make($image_tmp)->resize(1280, 720)->save($large_image_path);

                    // Store image in Services folder
                    $rservices->service_banner = $filename;
                }
            }
            $rservices->save();
            return redirect('/admin/repair-services')->with('flash_message_success', 'Repair Service Added Successfully!');
        }

        $repairservices = OtherServices::where(['parent_id'=>0])->get();
        $repairservices_dropdown = '<option value="0" selected="selected">Main Service</option>';

        foreach($repairservices as $rService){
            $repairservices_dropdown .= "<option value='".$rService->id."'><strong>".$rService->service_name."</strong></option>";
            $sub_repairservices = OtherServices::where(['parent_id'=>$rService->id])->get();
            foreach($sub_repairservices as $sub_rService){
                $repairservices_dropdown .= "<option value='".$sub_rService->id."'>&nbsp;--&nbsp;".$sub_rService->service_name."</option>";
                $sub_subrepairservices = OtherServices::where(['parent_id'=>$sub_rService->id])->get();
                foreach($sub_subrepairservices as $sub_subrService){
                    $repairservices_dropdown .= "<option value='".$sub_subrService->id."'>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;".$sub_subrService->service_name."</option>";
                }
            }
        }

        return view('admin.repair_services.add_repair_services', compact('repairservices_dropdown'));
    }

    // View All Repair Services
    public function viewRService()
    {
        $repairservices = OtherServices::get();
        return view('admin.repair_services.view_repair_service', compact('repairservices')); 
    }

    // Disable Property Service
    public function disableService(Request $request, $id=null)
    {
        if(!empty($id)){
            OtherServices::where(['id'=>$id])->update(['status'=>0]);
            return redirect()->back()->with('flash_message_success', 'Repair Service Disabled Successfully!');
        }
    }

    // Enable Property Service
    public function enableService(Request $request, $id=null)
    {
        if(!empty($id)){
            OtherServices::where(['id'=>$id])->update(['status'=>1]);
            return redirect()->back()->with('flash_message_success', 'Repair Service Enabled Successfully!');
        }
    }


    // View Single Other Service on Frontend
    public function SingleRepairService(Request $request, $url=null)
    {
        $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        
        $ots_data = OtherServices::where('url', $url)->get();

        $ots_p_id = $ots_data[0]['parent_id'];

        if($ots_p_id > 0){
            $ots_p_id = $ots_data[0]['parent_id'];
        }else{
            $ots_p_id = $ots_data[0]['id'];
        }

        $randervice = OtherServices::where('parent_id', $ots_p_id)->limit(4)->get();
        
        $propertyImages = PropertyImages::get();
        $otherServices = OtherServices::get();
        // $randervice = OtherServices::inRandomOrder()->limit(4)->get();
        $services = OtherServices::where(['url'=>$url])->get();
        $services = json_decode(json_encode($services));
        $sub_services = OtherServices::where(['parent_id'=>$services[0]->id])->get();
        $vendor = User::where(['usertype'=> 'V'])->where('country', $arr_ip->iso_code)->take(4)->get();
        
        $services_meta = json_decode(json_encode($services), true);

        if(!empty($services_meta[0]['meta_title'])){
            $meta_title = $services_meta[0]['meta_title'];
        }else{
            $meta_title = $services_meta[0]['service_name']." | IPC - Home Services and Repair Services";
        }
        if(!empty($services_meta[0]['meta_description'])){
            $meta_description = $services_meta[0]['meta_description'];
        }else{
            $meta_description = str_limit(strip_tags($services_meta[0]['s_description']), $limit=200);
        }
        if(!empty($services_meta[0]['meta_keywords'])){
            $meta_keywords = $services_meta[0]['meta_keywords'];
        }else{
            $meta_keywords = $services_meta[0]['service_name']." in ".$arr_ip->country.", ".$services_meta[0]['service_name']." in ".$arr_ip->state_name.", ".$services_meta[0]['service_name']." in ".$arr_ip->city.", ".$services_meta[0]['service_name']." near by ".$arr_ip->city;
        }
        if(!empty($services_meta[0]['canonical_url'])){
            $canonical_url = $services_meta[0]['canonical_url'];
        }else{
            $canonical_url = config('app.url')."/services/".$services_meta[0]['url'];
        }

        if(!empty($services_meta[0]['service_banner'])){
            $page_image = config('app.url')."/images/backend_images/repair_service_images/large/".$services_meta[0]['service_banner'];
        }else{
            $page_image = '';
        }


        return view('layouts.frontLayout.repair_services.single_repair_service')->with(compact('vendor' ,'randervice', 'services', 'otherServices', 'sub_services','meta_title','meta_description','meta_keywords','canonical_url','page_image'));
    }

    // Edit Repair Service function
    public function editRService(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }

            $rservices = new OtherServices;
            // Upload Repair Service image/icon
            if($request->hasFile('rservice_image')){
                $image_tmp = Input::file('rservice_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/repair_service_images/large/'.$filename;
                    // Resize image
                    Image::make($image_tmp)->resize(730, 464)->save($large_image_path);

                    // Store image in Services folder
                    $rservices->service_image = $filename;
                }
            }else {
                $filename = $data['current_image'];
            }

            // Upload Repair Service Banner
            if($request->hasFile('rservice_banner')){
                $image_tmp = Input::file('rservice_banner');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $bannername = rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/repair_service_images/large/'.$bannername;
                    // Resize image
                    Image::make($image_tmp)->resize(1920, 500)->save($large_image_path);

                    // Store image in Services folder
                    $rservices->service_banner = $bannername;
                }
            }else {
                $bannername = $data['current_banner'];
            }
            OtherServices::where(['id'=>$id])->update(['service_name'=>$data['rservice_name'], 'parent_id'=>$data['parent_id'], 's_description'=>$data['s_description'], 'description'=>$data['description'], 'url'=>$data['rservice_url'], 'status'=>$status, 'service_image'=>$filename, 'service_banner'=>$bannername]);
            return redirect('/admin/repair-services')->with('flash_message_success', 'Service updated Successfully!');
        }
        $servicesDetails = OtherServices::where(['id'=>$id])->first();
        $servicesDetails = json_decode(json_encode($servicesDetails));
        // echo "<pre>"; print_r($servicesDetails); die;
        
        // Repair Services Dropdown
        $repairServices = OtherServices::where(['parent_id'=>0])->get();
        $repairServices_dropdown = "<option selected value='0' >Main Service</option>";
        foreach($repairServices as $rService){
            if($rService->id==$servicesDetails->parent_id)
            {
                $selected = "selected";
            }else {
                $selected = "";
            }
            $repairServices_dropdown .= "<option value='".$rService->id."' ".$selected."><b>".$rService->service_name."</b></option>";
            $sub_repairServices = OtherServices::where(['parent_id'=>$rService->id])->get();
            foreach($sub_repairServices as $sub_rService){
                if($sub_rService->id==$servicesDetails->parent_id)
                {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $repairServices_dropdown .= "<option value='".$sub_rService->id."' ".$selected.">&nbsp;=>&nbsp;".$sub_rService->service_name."</option>";
                $sub_subRepairServices = OtherServices::where(['parent_id'=>$sub_rService->id])->get();
                foreach($sub_subRepairServices as $sub_subRService){
                    $repairServices_dropdown .= "<option value='".$sub_subRService->id."' ".$selected.">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;".$sub_subRService->service_name."</option>";
                }
            }
        }
        // echo "<pre>"; print_r($repairServices_dropdown); die;
        return view('admin.repair_services.edit_repair_service')->with(compact('servicesDetails', 'repairServices_dropdown'));
    }

    // Creating unique Slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(OtherServices::class, 'url', $request->rservice_name, ['unique' => true]);
        // echo "<pre>"; print_r($slug); die;
        return response()->json(['slug' => $slug]);
    }

    // Service Request by user
    public function serviceRequest(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $city_id = Cities::select('id')->where('name', $data['city_name'])->get();
            $city_id = json_decode(json_encode($city_id), true);
            $city_id = $city_id[0]['id'];
            // echo "<pre>"; print_r($city_id[0]['id']); die;

            if(!empty($data['sub_service'])) {
                $sub_services = $data['sub_service'];
            }else{
                $sub_services = '';
            }
            if(!empty($data['subs_service'])) {
                $subs_services = $data['subs_service'];
            }else{
                $subs_services = '';
            }

            RequestService::create([
                'name'              => $data['name'],
                'email'             => $data['email'],
                'phone'             => $data['phone'],
                'main_service'      => $data['main_service'],
                'sub_service'       => $sub_services,
                'subs_service'      => $subs_services,
                'project_status'    => $data['project_status'],
                'project_timeline'  => $data['project_timeline'],
                'address_type'      => $data['address_type'],
                'ownership'         => $data['ownership'],
                'financing'         => $data['financing'],
                'description'       => $data['description'],
                'address'           => $data['address'],
                'country'           => $data['country'],
                'state'             => $data['state'],
                'city_name'         => $city_id,
                'zipcode'           => $data['zipcode']
            ]);

            return redirect()->back()->with('flash_message_success', 'Request Submited Successfully!');
        }
        return view('layouts.frontLayout.repair_services.service_request');
    }


    // Auto City List
    public function search(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('cities')->where('name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="citylistdropdown">';
            foreach ($data as $row) {
                $flag = '<span class="flag_name">' . $row->id . '</span>';
                $output .= '<li id="type_search">' . $row->name . '</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    // Get Get SubServices List
    public function getSubServices(Request $request)
    {
        $subServices = OtherServices::where("parent_id", $request->parent_id)->pluck("service_name", "id");
        return response()->json($subServices);
    }

    // Request Service Function
    public function requestService()
    {
        $service_request = RequestService::get();
        return view('admin.queries.request_service', compact('service_request'));
    }

    // Update Service Request Status
    public function statusDone($id=null)
    {
        if($id)
        {
            RequestService::where('id', $id)->update(['status'=>1]);
            return redirect()->back()->with('flash_message_success', 'Task Completed!');
        }
    }

    // Update Service Request Status
    public function statusPending($id=null)
    {
        if($id)
        {
            RequestService::where('id', $id)->update(['status'=>0]);
            return redirect()->back()->with('flash_message_success', 'Task Pending!');
        }
    }

    // Assign Vendor to Service
    public function assignVendorService(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if($id)
            {
                RequestService::where('id', $id)->update(['assign_to'=>$data['vendor_id']]);
                return redirect('/admin/service-requests')->with('flash_message_success', 'Vendor Assigned Successfully!');
            }
        }
    }
}
