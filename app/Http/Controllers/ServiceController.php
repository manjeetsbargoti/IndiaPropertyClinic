<?php

namespace App\Http\Controllers;

Use Image;
Use App\Services;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Input;

class ServiceController extends Controller
{
    // This is the function for Add New Service by Admin
    public function addService(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            if(empty($data['status'])){
                $status = 0;
            }else {
                $status = 1;
            }
            $services = new Services;
            $services->service_name = $data['service_name'];
            $services->parent_id    = $data['parent_id'];
            $services->description  = $data['description'];
            $services->url          = $data['service_url'];
            $services->status       = $status;

            // echo "<pre>"; print_r($data); die;

            // Upload image/icon
            if($request->hasFile('service_image')){
                $image_tmp = Input::file('service_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/service_images/large/'.$filename;
                    // Resize image
                    Image::make($image_tmp)->resize(730, 464)->save($large_image_path);

                    // Store image in Services folder
                    $services->service_image = $filename;
                }
            }
            $services->save();
            return redirect('/admin/services')->with('flash_message_success', 'Property Service Added Successfully!');
        }
        $levels = Services::where(['parent_id'=>0])->get();
        return view('admin.services.add_service', compact('levels'));
    }

    // Services view method
    public function viewService()
    {
        $services = Services::get();
        return view('admin.services.view_services', compact('services'));
    }

    // Disable Property Service
    public function disableService(Request $request, $id=null)
    {
        if(!empty($id)){
            Services::where(['id'=>$id])->update(['status'=>0]);
            return redirect()->back()->with('flash_message_success', 'Property Service Disabled Successfully!');
        }
    }

    // Enable Property Service
    public function enableService(Request $request, $id=null)
    {
        if(!empty($id)){
            Services::where(['id'=>$id])->update(['status'=>1]);
            return redirect()->back()->with('flash_message_success', 'Property Service Enabled Successfully!');
        }
    }

}
