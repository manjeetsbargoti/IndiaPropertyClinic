<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    // Get System Options
    public function getOptions(){
        return view('admin.system.options');
    }

    // Get Robots.txt
    public function getRobot(){
        $data['robots'] = file_get_contents(public_path('robots.txt'));
        return view('admin.system.robots', $data);
    }

    // Save Robot.txt
    public function postRobot(Request $request){
        file_put_contents(public_path('robots.txt'),$request->robots_txt);
        return back();
    }

    // Get .htaccess
    public function getHtaccess(){
        $data['htaccess'] = file_get_contents(public_path('.htaccess'));
        return view('admin.system.htaccess',$data);
    }

    // Save .htaccess
    public function postHtaccess(Request $request){
        file_put_contents(public_path('.htaccess'),$request->htaccess);
        return back();
    }

    // Get Custom Codes
    public function getCode(){
        $data['header'] = file_get_contents(resource_path('views/admin/system/partials/code_head.blade.php'));
        $data['footer'] = file_get_contents(resource_path('views/admin/system/partials/code_footer.blade.php'));
        return view('admin.system.code',$data);
    }

    // Save Custom Codes
    public function postCodes(Request $request){
        file_put_contents(resource_path('views/admin/system/partials/code_head.blade.php'),$request->custom_code_header);
        file_put_contents(resource_path('views/admin/system/partials/code_footer.blade.php'),$request->custom_code_footer);
        return back();
    }
}
