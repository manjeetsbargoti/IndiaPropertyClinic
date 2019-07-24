<?php

namespace App\Http\Controllers;

use DB;
Use Image;
Use App\User;
Use App\Property;
Use App\Services;
use App\OtherServices;
Use App\PropertyImages;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Input;
use \Cviebrock\EloquentSluggable\Services\SlugService;

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
        $propertyImages = PropertyImages::get();
        $otherServices = OtherServices::get();
        $randervice = OtherServices::inRandomOrder()->limit(4)->get();
        $services = OtherServices::where(['url'=>$url])->get();
        $services = json_decode(json_encode($services));
        $sub_services = OtherServices::where(['parent_id'=>$services[0]->id])->get();
        $vendor = User::where(['usertype'=> 'V'])->get();
        // echo "<pre>"; print_r($sub_services); die;

        // foreach($vendor as $key => $val)
        // {
        //     $countryname = DB::table('countries')->where(['id'=>$val->country])->first();
        //     $vendor[$key]->country_name = $countryname->name;
        //     $state = DB::table('states')->where(['id'=>$val->state])->first();
        //     $vendor[$key]->state_name = $state->name;
        //     $city = DB::table('cities')->where(['id'=>$val->city])->first();
        //     $vendor[$key]->city_name = $city->name;
        // }

        return view('layouts.frontLayout.repair_services.single_repair_service')->with(compact('vendor' ,'randervice', 'services', 'otherServices', 'sub_services'));
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
            OtherServices::where(['id'=>$id])->update(['service_name'=>$data['rservice_name'], 's_description'=>$data['s_description'], 'description'=>$data['description'], 'url'=>$data['rservice_url'], 'status'=>$status, 'service_image'=>$filename, 'service_banner'=>$bannername]);
            return redirect('/admin/repair-services')->with('flash_message_success', 'Service updated Successfully!');
        }
        $servicesDetails = OtherServices::where(['id'=>$id])->first();
        $servicesDetails = json_decode(json_encode($servicesDetails));
        // echo "<pre>"; print_r($servicesDetails); die;
        // Repair Services Dropdown
        $repairServices = OtherServices::where(['parent_id'=>0])->get();
        $repairServices_dropdown = "<option selected disabled>Select Service</option>";
        foreach($repairServices as $rService){
            if($rService->id==$servicesDetails->parent_id)
            {
                $selected = "selected";
            }else {
                $selected = "";
            }
            $repairServices_dropdown .= "<option value='".$rService->id."'><b>".$rService->service_name."</b></option>";
            $sub_repairServices = OtherServices::where(['parent_id'=>$rService->id])->get();
            foreach($sub_repairServices as $sub_rService){
                if($sub_rService->id==$servicesDetails->parent_id)
                {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $repairServices_dropdown .= "<option value='".$sub_rService->id."'>&nbsp;--&nbsp;".$sub_rService->service_name."</option>";
                $sub_subRepairServices = OtherServices::where(['parent_id'=>$sub_rService->id])->get();
                foreach($sub_subRepairServices as $sub_subRService){
                    $repairServices_dropdown .= "<option value='".$sub_subRService->id."'>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;".$sub_subRService->service_name."</option>";
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
            echo "<pre>"; print_r($data); die;
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
                $output .= '<li>' . $row->name . '</li>';
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
}
