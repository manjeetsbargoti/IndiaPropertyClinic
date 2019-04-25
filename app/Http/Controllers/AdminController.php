<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\User;
use Socialite;
use Exception;
use App\Cities;
use App\Property;
use App\Services;
use App\UserType;
use App\OtherServices;
use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AdminController extends Controller
{
    public function adminLogin(Request $request, $guard = null)
    {
        $userData = Auth::user();

        // if (Auth::guard($guard)->check()) {
        //     Session::put('Auth', $data['email']);
        //     return redirect('/admin/dashboard');
        // }
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1', 'status' => '1'])) {
                return redirect('/admin/dashboard')->with(compact('userData'));
            } else {
                return redirect('/admin')->with('flash_message_error', 'Invelid Email Address or Password!');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $actusers = User::where(['status' => 1])->orderBy('created_at', 'desc')->get();
        $inactusers = User::where(['status' => 0])->orderBy('created_at', 'desc')->get();
        $property = Property::orderBy('created_at', 'desc')->get();
        $propertyImages = PropertyImages::get();
        $property = json_decode(json_encode($property));
        $propertyImages = json_decode(json_encode($propertyImages));

        foreach ($property as $key => $val) {
            $service_name = Services::where(['id' => $val->service_id])->first();
            $property[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id' => $val->id])->first();
            $property[$key]->image_name = $propertyimage_name->image_name;
        }

        // echo "<pre>"; print_r($actusers); die;

        // Count Number of Users
        if (!empty($users)) {
            $contUser = count($users);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contUser = 0;
        }

        // Count Number of Active Users
        if (!empty($actusers)) {
            $contActUser = count($actusers);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contActUser = 0;
        }

        // Count Number of Inactive Users
        if (!empty($inactusers)) {
            $contInactUser = count($inactusers);
            // echo "<pre>"; print_r($contRow); die;
        } else {
            $contInactUser = 0;
        }

        return view('admin.dashboard', compact('property', 'users', 'contUser', 'contActUser', 'contInactUser'));
    }

    // Admin Logut Function
    public function getOut()
    {
        Auth::logout();
        Session::forget('Auth');
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
        if ($request->isMethod('POST')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $user = new User;

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->country = $data['country'];
            $user->state = $data['state'];
            $user->city = $data['city'];
            $user->phonecode = $data['phonecode'];
            $user->phone = $data['phone'];
            $user->password = bcrypt($data['password']);
            $user->usertype = $data['usertype'];
            $user->servicetypeid = $data['servicetype'];

            $user->save();

            // User Register Email
            // $email = $data['email'];
            // $messageData = ['email'=>$data['email'], 'name'=>$data['first_name']];
            // Mail::send('emails.register', $messageData, function($message) use($email){
            //     $message->to($email)->subject('Registration with India Property Clinic');
            // });

            return redirect('/admin/users')->with('flash_message_success', 'User Added Successfully!');
        }

        $servicetype = OtherServices::where(['parent_id' => 0])->get();
        $usertype = UserType::get();
        $phonecode = DB::table('countries')->get();
        $countryname = DB::table('countries')->pluck("name", "id");
        return view("admin.users.add_new_user", compact('phonecode', 'usertype', 'servicetype', 'countryname'));
    }

    // Verify Registered User Email
    public function verifyEmail(Request $request, $email = null)
    {
        $email = base64_decode($email);
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email', $email)->first();
            if ($userDetails->status == 1) {
                return redirect('/login')->with('flash_message_success', 'Your account already Activated! Please login now.');
            } else {
                User::where('email', $email)->update(['status' => 1]);

                // User Welcome Email
                $messageData = ['email' => $email, 'name' => $userDetails->first_name];
                Mail::send('emails.register', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Registration with India Property Clinic');
                });

                return redirect('/login')->with('flash_message_success', 'Your Email account Activated! Please login now.');
            }
        } else {
            // abort(404);
            echo "Verification Failed!";
        }
    }

    // Getting State List according to Country
    public function getStateList(Request $request)
    {
        $states = DB::table("states")->where("country_id", $request->country_id)->pluck("name", "id");
        return response()->json($states);
    }

    // Getting City List according to State
    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")->where("state_id", $request->state_id)->pluck("name", "id");
        return response()->json($cities);
    }

    // View All User
    public function viewUser(Request $request)
    {
        $user = User::where(['admin' => 0])->orderBy('created_at', 'desc')->get();
        $user = json_decode(json_encode($user));

        foreach ($user as $key => $val) {
            $usertype = UserType::where(['usercode' => $val->usertype])->first();
            $user[$key]->usertype_name = $usertype->usertype_name;
            $rservices_count = OtherServices::where(['id' => $val->servicetypeid])->count();
            if ($rservices_count > 0) {
                $rservices = OtherServices::where(['id' => $val->servicetypeid])->first();
                $user[$key]->service_name = $rservices->service_name;
            }
        }

        // echo "<pre>"; print_r($user); die;

        return view("admin.users.view_users", compact('user'));
    }

    // Disable User
    public function disableUser(Request $request, $id = null)
    {
        if (!empty($id)) {
            User::where(['id' => $id])->update(['status' => 0]);
            return redirect()->back()->with('flash_message_success', 'User Disabled Successfully!');
        }
    }

    // Enable User
    public function enableUser(Request $request, $id = null)
    {
        if (!empty($id)) {
            User::where(['id' => $id])->update(['status' => 1]);
            return redirect()->back()->with('flash_message_success', 'User Enabled Successfully!');
        }
    }

    // Edit User
    public function editUser(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $user = new User;
            // echo  "<pre>"; print_r($id); die;
            if (!empty($id)) {
                User::where(['id' => $id])->update(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phonecode' => $data['phonecode'], 'phone' => $data['phone'], 'country' => $data['country'], 'state' => $data['state'], 'city' => $data['city']]);
                return redirect('/admin/users')->with('flash_message_success', 'User updated Successfully!');
            }
        }

        $userdetails = User::where(['id' => $id])->first();
        $userdetails = json_decode(json_encode($userdetails));
        $servicetype = OtherServices::where(['parent_id' => 0])->get();
        $usertype = UserType::get();
        $phonecode = DB::table('countries')->get();
        $countryname = DB::table('countries')->get();
        $statename = DB::table('states')->where(['country_id' => $userdetails->country])->get();
        $cityname = DB::table('cities')->where(['state_id' => $userdetails->state])->get();

        // Select Country Name
        $country_dropdown = "<option selected value=''>Select Country</option>";
        foreach ($countryname as $cname) {
            if ($cname->id == $userdetails->country) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $country_dropdown .= "<option value='" . $cname->id . "' " . $selected . ">" . $cname->name . "</option>";
        }

        // Select State Name
        $state_dropdown = "<option selected value=''>Select State</option>";
        foreach ($statename as $sname) {
            if ($sname->id == $userdetails->state) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $state_dropdown .= "<option value='" . $sname->id . "' " . $selected . ">" . $sname->name . "</option>";
        }

        // Select City Name
        $city_dropdown = "<option selected value=''>Select City</option>";
        foreach ($cityname as $cname) {
            if ($cname->id == $userdetails->city) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $city_dropdown .= "<option value='" . $cname->id . "' " . $selected . ">" . $cname->name . "</option>";
        }

        // Selecct Service Type
        $services_dropdown = "<option selected value=''>Select</option>";
        foreach ($servicetype as $stype) {
            if ($stype->id == $userdetails->servicetypeid) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $services_dropdown .= "<option value='" . $stype->id . "' " . $selected . ">" . $stype->service_name . "</option>";
        }

        // Select Phone Code
        $phone_code = "<option selected value=''>Select</option>";
        foreach($phonecode as $pcode){
            if($pcode->id == $userdetails->country){
                $selected = 'selected';
            }else{
                $selected="";
            }
            $phone_code .= "<option value='" . $pcode->phonecode . "' " . $selected . ">" . $pcode->phonecode . " " . $pcode->iso3. "</option>";
        }

        // echo  "<pre>"; print_r($userdetails); die;

        return view('admin.users.edit_user', compact('userdetails', 'services_dropdown', 'usertype', 'phonecode', 'country_dropdown', 'state_dropdown', 'city_dropdown', 'phone_code'));
    }

    // User Login Function
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => 0])) {
                $userStatus = User::where(['email' => $data['email']])->first();
                if ($userStatus->status == 0) {
                    Session::Flush();
                    return redirect()->back()->with('flash_message_error', 'Your account has been disabled! Please contact Admin.');
                } else {
                    Session::put('UserSession', $data['email']);
                    return redirect('/My-Account');
                }
            } else {
                return redirect()->back()->with('flash_message_error', 'Invalid Username or Password!');
            }
        }

        return view('auth.login');
    }

    // Reset user Password
    public function resetPassword()
    {

        return view('auth.passwords.reset');
    }

    // User Register Function
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $userCount = User::where('email', $data['email'])->count();

            if ($userCount > 0) {
                return redirect()->back()->with('flash_message_error', 'A User with this Email already exists.');
            } else {

                $user = new User;

                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->phonecode = $data['phonecode'];
                $user->phone = $data['mobilenumber'];
                $user->usertype = $data['usertype'];
                $user->servicetypeid = $data['servicetype'];

                $user->save();

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'name' => $data['first_name'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm account with India Property Clinic');
                });

                return redirect('/login')->with('flash_message_success', 'Please confirm your email to activate your account!');
                // return redirect('/login')->with('flash_message_success', 'You are Registered Successfully! Please Check your Email and Verify.');

            }
        }

        $usertypes = UserType::where(['status' => 1])->get();
        $servicetype = OtherServices::where(['status' => 1, 'parent_id' => 0])->get();
        $countrycode = DB::table('countries')->get();
        $countryname = DB::table('countries')->pluck("name", "id");

        return view('auth.register', compact('usertypes', 'servicetype', 'countrycode', 'countryname'));
    }

    // User Account
    public function userAccount()
    {
        $data = Auth::user();
        // $data = json_decode(json_encode($data));
        $id = $data['id'];
        // echo "<pre>"; print_r($id); die;
        $users = User::where(['id' => $id])->get();
        // $users = json_decode(json_encode($users));

        foreach ($users as $key => $val) {
            $rservice_count = OtherServices::where(['id' => $val->servicetypeid])->count();
            if ($rservice_count) {
                $rservice_name = OtherServices::where(['id' => $val->servicetypeid])->first();
                $users[$key]->service_name = $rservice_name->service_name;
            }
            $usertype_name = UserType::where(['usercode' => $val->usertype])->first();
            $users[$key]->user_type = $usertype_name->usertype_name;
            $country_count = DB::table('countries')->where(['id' => $val->country])->count();
            if ($country_count > 0) {
                $country = DB::table('countries')->where(['id' => $val->country])->first();
                $users[$key]->country_name = $country->name;
            }
            $state_count = DB::table('states')->where(['id' => $val->state])->count();
            if ($state_count > 0) {
                $state = DB::table('states')->where(['id' => $val->state])->first();
                $users[$key]->state_name = $state->name;
            }
            $city_count = DB::table('cities')->where(['id' => $val->city])->count();
            if ($city_count > 0) {
                $city = DB::table('cities')->where(['id' => $val->city])->first();
                $users[$key]->city_name = $city->name;
            }

        }
        // echo "<pre>"; print_r($users); die;

        return view('auth.users.user_account', compact('users', 'country_count', 'state_count', 'city_count'));
    }

    // User Logout Function
    public function logout()
    {
        Auth::logout();
        Session::forget('UserSession');
        return redirect('/login')->with('flash_message_success', 'Logged out Successfully!');
    }

    // Check User Email
    public function checkEmail(Request $request)
    {
        if ($request->get('email')) {
            $email = $request->get('email');
            $data = User::where('email', $email)->count();
            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    // Add Country, State, City in Database
    public function addCity(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $city = new Cities;

            $city->state_id = $data['state'];
            $city->country_id = $data['country'];
            $city->name = $data['city_name'];

            $city->save();

            return redirect()->back()->with('flash_message_success', 'City Added Successfully!');
        }

        $countryname = DB::table('countries')->pluck("name", "id");

        return view('admin.csc_temp.add_city', compact('countryname'));
    }

    // CheckPassword function
    public function chkpassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "ture"; die;
        }else{
            echo "false"; die;
        }
    }

    // Change Password
    public function changePassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $check_password = User::where(['email'=>Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('id', '1')->update(['password'=>$password]);
                return redirect('/admin/profile')->with('flash_message_success', 'Password updated Successfully!');
            }else {
                return redirect('/admin/settings')->with('flash_message_error', 'Current Password is Incorrect!');
            }
        }
    }

    // Login via Twitter
    public function redirect($provider=null)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider=null)
    {
               
        $getInfo = Socialite::driver($provider)->user();
        // echo "<pre>"; print_r($getInfo); die;
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->to('/');
 
    }

    function createUser($getInfo,$provider){
 
        $user = User::where('provider_id', $getInfo->id)->first();
    
        if (!$user) {
            $user = User::create([
               'first_name' => $getInfo->name,
               'email'    => $getInfo->email,
               'provider' => $provider,
               'provider_id' => $getInfo->id
           ]);
         }
         return $user;
      }

    // public function handleTwitterCallback()
    // {
    //     try {
    //         $user = Socialite::driver('twitter')->user();
    //         $create['name'] = $user->name;
    //         $create['email'] = $user->email;
    //         $create['twitter_id'] = $user->id;
            
    //         // $usernew = User::create([
    //         //     'first_name' => $create['name'],
    //         //     'email' => $create['email'],
    //         //     'twitter_id' => $create['twitter_id'],
    //         // ]);

    //         echo "<pre>"; print_r($create); die;

    //         $userModel = new User;
    //         $createdUser = $userModel->addNew($create);
    //         Auth::loginUsingId($createdUser->id);
    //         return redirect('/home');
    //     } catch (Exception $e) {
    //         return redirect('/auth/twitter');
    //     }
    // }
}
