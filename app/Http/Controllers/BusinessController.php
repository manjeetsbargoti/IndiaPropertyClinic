<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Country;
use App\Business;
use App\OtherServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BusinessController extends Controller
{
    // Business List by Vendor
    public function listBusiness(Request $request)
    {
        $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);

        if($request->isMethod('Post'))
        {
            $data = $request->all();
            // echo"<pre>"; print_r($data);die;

            $email = $data['email'];
            $user_count = User::where('email', $email)->count();

            // $rservice = implode(',', $data['offered_service']);
            $rservice = $data['offered_service'];
            // echo"<pre>"; print_r($rservice);die;

            if($user_count > 0){

                $user_data = User::where('email', $email)->first();
                $user_id = $user_data['id'];

                // echo"<pre>"; print_r($user_id);die;

                DB::beginTransaction();

                try{
                    $business = Business::create([
                        'business_name'         => $data['business_name'],
                        'experience'            => $data['experience'],
                        'business_description'  => $data['business_description'],
                        'owner_name'            => $data['first_name']." ".$data['last_name'],
                        'country'               => $data['business_country'],
                        'state'                 => $data['business_state'],
                        'city'                  => $data['business_city'],
                        'user_id'               => $user_id,
                    ]);
                }catch(ValidationException $e){
                    DB::rollback();
                    return Redirect()->back()->withErrors($e->getErrors())->withInput();
                }catch(\Exception $e){
                    DB::rollback();
                    throw $e;
                }

                DB::commit();

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'name' => $data['first_name'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.generate_user_password', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Generate account password and Confirm account with India Property Clinic');
                });
            }else{

                DB::beginTransaction();

                try{

                    $user = User::create([
                        'first_name'            => $data['first_name'],
                        'last_name'             => $data['last_name'],
                        'email'                 => $data['email'],
                        'phone'                 => $data['phone'],
                        'business_name'         => $data['business_name'],
                        'experience'            => $data['experience'],
                        'about_business'        => $data['business_description'],
                        'country'               => $data['business_country'],
                        'state'                 => $data['business_state'],
                        'city'                  => $data['business_city'],
                        'servicetypeid'         => $rservice,
                        'usertype'              => 'V'
                    ]);

                }catch(ValidationException $e){
                    DB::rollback();
                    return Redirect()->back()->withErrors($e->getErrors())->withInput();
                }catch(\Exception $e){
                    DB::rollback();
                    throw $e;
                }

                try{
                    $business = Business::create([
                        'business_name'         => $data['business_name'],
                        'experience'            => $data['experience'],
                        'business_description'  => $data['business_description'],
                        'owner_name'            => $data['first_name']." ".$data['last_name'],
                        'country'               => $data['business_country'],
                        'state'                 => $data['business_state'],
                        'city'                  => $data['business_city'],
                        'user_id'               => $user->id,
                    ]);
                }catch(ValidationException $e){
                    DB::rollback();
                    return Redirect()->back()->withErrors($e->getErrors())->withInput();
                }catch(\Exception $e){
                    DB::rollback();
                    throw $e;
                }

                DB::commit();

                // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email' => $data['email'], 'name' => $data['first_name'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.generate_user_password', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Generate account password and Confirm account with India Property Clinic');
                });
            }

            return redirect()->back()->with('flash_message_success','Business Submitted Successfully! Please Check your email and generate password.');

        }

        $repair_services = OtherServices::where('parent_id', 0)->orderBy('service_name', 'asc')->get();
        $countries = Country::orderBy('name', 'asc')->get();

        $meta_title = "List Your Business | India Property Clinic";
        $meta_description = "List your business with India Property Clinic | Property Listing and Home Services";
        $meta_keywords = "Sale or Rent Property in $arr_ip->country, Sale or Rent Property in $arr_ip->state_name, Sale or Rent Property in $arr_ip->city, Home Services in $arr_ip->city, Home Services in $arr_ip->state_name, Repair Services in $arr_ip->city, Repair Services in $arr_ip->state_name";

        return view('frontend.list_business', compact('countries', 'repair_services','meta_title','meta_description','meta_keywords'));
    }
}
