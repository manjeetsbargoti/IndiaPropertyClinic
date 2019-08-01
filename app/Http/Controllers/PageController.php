<?php

namespace App\Http\Controllers;

use Image;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Input;

class PageController extends Controller
{
    // Add New CMS Pages
    public function newPage(Request $request)
    {
        if($request->isMethod('post'))
        {
            $add_by = Auth::user()->id;
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Repair Service image/icon
            if($request->hasFile('feature_image')){
                $image_tmp = Input::file('feature_image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'IPC_Page_'.rand(1, 99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/page_images/large/'.$filename;
                    // Resize image
                    Image::make($image_tmp)->resize(1280, 720)->save($large_image_path);

                    // Store image in Services folder
                    // $rservices->service_image = $filename;
                }
            }

            Page::create([
                'title'     => $data['page_title'],
                'url'       => $data['slug'],
                'content'   => $data['description'],
                'page_type' => $data['page_type'],
                'template'  => $data['template'],
                'status'  => $data['page_status'],
                'add_by'  => $add_by,
                'image'   => $filename
            ]);

            return redirect()->back()->with('flash_message_success', 'Page Published Successfully!');

        }
        return view('admin.pages.new_page');
    }
}
