<?php

namespace App\Http\Controllers;

use DB;
use App\Option;
use App\Contact;
use App\Property;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class SystemController extends Controller
{
    // Get System Options
    public function getOptions()
    {
        $data['options'] = Option::get();
        return view('admin.system.options', $data);
    }

    // Update System Options
    public function postOption(Request $request)
    {
        $option = Option::where('key', '=', 'app.name')->first();
        $option->value = $request->site_name ?: $option->value;
        $option->save();

        $option = Option::where('key', '=', 'app.url')->first();
        $option->value = $request->site_url ?: $option->value;
        $option->save();

        if (isset($request->site_logo)) {
            $request->site_logo->move(public_path(), 'logo.svg');
        }

        if (isset($request->site_icon)) {
            $request->site_icon->move(public_path(), 'favicon.ico');
        }

        return back()->with(['flash_message_success' => 'Updated']);
    }

    // Get Robots.txt
    public function getRobot()
    {
        $data['robots'] = file_get_contents(public_path('robots.txt'));
        return view('admin.system.robots', $data);
    }

    // Save Robot.txt
    public function postRobot(Request $request)
    {
        file_put_contents(public_path('robots.txt'), $request->robots_txt);
        return back();
    }

    // Get Style.css
    public function getStyle()
    {
        $data['styles'] = file_get_contents(public_path('css/frontend_css/style.css'));
        return view('admin.system.editor', $data);
    }

    // Save Style.css
    public function postStyle(Request $request)
    {
        file_put_contents(public_path('css/frontend_css/style.css'), $request->style_css);
        return back();
    }

    // Get .htaccess
    public function getHtaccess()
    {
        $data['htaccess'] = file_get_contents(public_path('.htaccess'));
        return view('admin.system.htaccess', $data);
    }

    // Save .htaccess
    public function postHtaccess(Request $request)
    {
        file_put_contents(public_path('.htaccess'), $request->htaccess);
        return back();
    }

    // Get Custom Codes
    public function getCode()
    {
        $data['header'] = file_get_contents(resource_path('views/admin/system/partials/code_head.blade.php'));
        $data['footer'] = file_get_contents(resource_path('views/admin/system/partials/code_footer.blade.php'));
        return view('admin.system.code', $data);
    }

    // Save Custom Codes
    public function postCodes(Request $request)
    {
        file_put_contents(resource_path('views/admin/system/partials/code_head.blade.php'), $request->custom_code_header);
        file_put_contents(resource_path('views/admin/system/partials/code_footer.blade.php'), $request->custom_code_footer);
        return back();
    }

    // Get Sitemap
    public function getSitemap()
    {
        $data['options'] = Option::get();
        return view('admin.system.seo.sitemap', $data);
    }

    // Generate andSave Sitemap
    public function postSitemap(Request $request)
    {

        // $data = $request->all();
        // dd($data);

        $option = Option::where('key', '=', 'sitemap_add_properties')->first();
        $option->value = $request->sitemap_add_properties ?: $option->value;
        $option->save();

        $option = Option::where('key', '=', 'sitemap_add_categories')->first();
        $option->value = $request->sitemap_add_categories ?: $option->value;
        $option->save();

        $option = Option::where('key', '=', 'sitemap_add_services')->first();
        $option->value = $request->sitemap_add_services ?: $option->value;
        $option->save();

        $option = Option::where('key', '=', 'sitemap_links')->first();
        $option->value = $request->sitemap_links ?: $option->value;
        $option->save();

        $option = Option::where('key', '=', 'sitemap_created_at')->first();
        $option->value = $request->sitemap_created_at ?: $option->value;
        $option->save();
        // dd($option2);

        if ($request->submit) {
            Artisan::call('generate:sitemap');
        }

        return back();
    }

    // Add New Contact
    public function newContact(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;

            Contact::create([
                'name'          => $data['contact_name'],
                'phone'         => $data['phone'],
                'description'   => $data['description']
            ]);
            return redirect()->back()->with('flash_message_success', 'Contact Added Successfully!');
        }
        return view('admin.contact.add_contact');
    }

    // View Contact List
    public function contactList()
    {
        return view('admin.contact.contact_list');
    }

    // Getting property images from Property Images table and uploading to Property table
    public function pImages(Request $request)
    {
        $properties = Property::select('id')->orderBy('id', 'asc')->get();
        $properties = json_decode(json_encode($properties));
        
        // echo "<pre>"; print_r($prop_img_data); die;

        foreach ($properties as $property) {
            
            $prop_img_data_count = PropertyImages::where('property_id', $property->id)->count();
            if ($prop_img_data_count > 0) {
                $sql = "SELECT GROUP_CONCAT(image_name) AS 'image_names' FROM `property_images` where  `property_id` = $property->id GROUP BY `property_id`";
                $prop_img_data = DB::select(DB::raw($sql));
                $prop_img_data = json_decode(json_encode($prop_img_data));
                $prop_img_data = $prop_img_data[0];
                $prop_img_data = $prop_img_data->image_names;
                // echo "<pre>"; print_r($prop_img_data_count); die;
                Property::where('id', $property->id)->update(['images' => $prop_img_data]);
            } else {
                Property::where('id', $property->id)->update(['images' => 'default.jpg']);
            }
        }
    }
}
