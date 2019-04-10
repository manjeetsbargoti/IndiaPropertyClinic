<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use App\UserType;
use App\Services;
// use Auth;
use Session;
Use App\OtherServices;
use App\Property;
use App\PropertyImages;
Use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminLogin(Request $request, $guard = null)
    {
        $userData = Auth::user();

        if (Auth::guard($guard)->check()) {
            return redirect('/admin/dashboard');
        }
        if($request->isMethod('post'))
        {
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1', 'status' => '1']))
            {
                return redirect('/admin/dashboard')->with(compact('userData'));
            }
            else if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '0', 'status' => '1']))
            {
                return redirect('/dashboard')->with('flash_message_success', 'Welcome! User');
            }
            else
            {
                return redirect('/admin')->with('flash_message_error', 'Invelid Email Address or Password!');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $actusers = User::where(['status'=>1])->orderBy('created_at', 'desc')->get();
        $inactusers = User::where(['status'=>0])->orderBy('created_at', 'desc')->get();
        $property = Property::orderBy('created_at', 'desc')->get();
        $propertyImages = PropertyImages::get();
        $property = json_decode(json_encode($property));
        $propertyImages = json_decode(json_encode($propertyImages));

        foreach($property as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            $property[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $property[$key]->image_name = $propertyimage_name->image_name;
        }

        // echo "<pre>"; print_r($actusers); die;

        // Count Number of Users
        if(!empty($users)){
            $contUser = count($users);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contUser = 0;
        }

        // Count Number of Active Users
        if(!empty($actusers)){
            $contActUser = count($actusers);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contActUser = 0;
        }

        // Count Number of Inactive Users
        if(!empty($inactusers)){
            $contInactUser = count($inactusers);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contInactUser = 0;
        }

        return view('admin.dashboard', compact('property', 'users', 'contUser', 'contActUser', 'contInactUser'));
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully!');
    }

    public function adminProfile()
    {
        return view('admin.admin_profile');
    }

    //********************************************************************//
    //                                                                    //
    //===================== User Module By Admin =========================//
    //                                                                    //
    //********************************************************************//

    // Add User by Admin
    public function addUser(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $user = new User;

            $user->first_name       = $data['first_name'];
            $user->last_name        = $data['last_name'];
            $user->email            = $data['email'];
            $user->country          = $data['country'];
            $user->state            = $data['state'];
            $user->city             = $data['city'];
            $user->phonecode        = $data['phonecode'];
            $user->phone            = $data['phone'];
            $user->password         = bcrypt($data['password']);
            $user->usertype         = $data['usertype'];
            $user->servicetypeid    = $data['servicetype'];

            $user->save();

            return redirect('/admin/users')->with('flash_message_success', 'User Added Successfully!');
        }

        $servicetype = OtherServices::where(['parent_id'=>0])->get();
        $usertype = UserType::get();
        $phonecode = DB::table('countries')->get();
        $countryname = DB::table('countries')->pluck("name","id");
        return view("admin.users.add_new_user", compact('phonecode', 'usertype', 'servicetype','countryname'));
    }

    // Getting State List according to Country
    public function getStateList(Request $request)
    {
        $states = DB::table("states")->where("country_id", $request->country_id)->pluck("name","id");
        return response()->json($states);
    }

    // Getting City List according to State
    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")->where("state_id", $request->state_id)->pluck("name","id");
        return response()->json($cities);
    }

    // View All User
    public function viewUser(Request $request)
    {
        $user = User::where(['admin'=>0])->get();
        $user = json_decode(json_encode($user));

        foreach($user as $key => $val) {
            $usertype = UserType::where(['usercode'=>$val->usertype])->first();
            $user[$key]->usertype_name = $usertype->usertype_name;
        }

        // echo "<pre>"; print_r($user); die;

        return view("admin.users.view_users", compact('user'));
    }

    // Disable User
    public function disableUser(Request $request, $id=null)
    {
        if(!empty($id)){
            User::where(['id'=>$id])->update(['status'=>0]);
            return redirect()->back()->with('flash_message_success', 'User Disabled Successfully!');
        }
    }

    // Enable User
    public function enableUser(Request $request, $id=null)
    {
        if(!empty($id)){
            User::where(['id'=>$id])->update(['status'=>1]);
            return redirect()->back()->with('flash_message_success', 'User Enabled Successfully!');
        }
    }

    // Edit User
    public function editUser(Request $request, $id=null)
    {
        
    }


}

