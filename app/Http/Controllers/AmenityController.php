<?php

namespace App\Http\Controllers;

use App\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    // Add Amenity
    public function addAmenity(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $amenity = Amenity::create([
                'name'          => $data['amenity_name'],
                'amenity_code'  => $data['amenity_code'],
                'description'   => $data['description']
            ]);

            return redirect('/admin/amenities')->with('flash_message_success', 'Amenity Added Successfully!');
        }
        return view('admin.property.add_amenities');
    }

    // View All Amenities in List
    public function viewAmenity()
    {
        $amenities = Amenity::orderBy('created_at', 'desc')->get();

        return view('admin.property.amenities', compact('amenities'));
    }

    // Edit Amenity
    public function editAmenity(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            Amenity::where('id', $id)->update(['name'=>$data['amenity_name'],'description'=>$data['description']]);

            return redirect('/admin/amenities')->with('flash_message_success', 'Amenity Updated Successfully!');
        }

        $amenity = Amenity::where(['id' => $id])->first();

        return view('admin.property.edit_amenity', compact('amenity'));
    }

    // Enable Amenity
    public function enableAmenity(Request $request, $id=null)
    {
        if(!empty($id))
        {
            Amenity::where('id', $id)->update(['status'=>1]);

            return redirect()->back()->with('flash_message_success', 'Amenity Enabled Successfully!');
        }
    }

    // Disable Amenity
    public function disableAmenity(Request $request, $id=null)
    {
        if(!empty($id))
        {
            Amenity::where('id', $id)->update(['status'=>0]);

            return redirect()->back()->with('flash_message_success', 'Amenity Disabled Successfully!');
        }
    }

    // Delete Amenity
    public function deleteAmenity(Request $request, $id=null)
    {
        if(!empty($id))
        {
            Amenity::where('id', $id)->delete();

            return redirect()->back()->with('flash_message_success', 'Amenity Deleted Successfully!');
        }
    }
}
