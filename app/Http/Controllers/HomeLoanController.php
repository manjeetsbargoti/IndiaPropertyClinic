<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
Use DB;
use App\Services;
use App\Cities;
use App\Property;
use App\HomeLoan;
use App\PropertyTypes;
Use App\OtherServices;
Use App\PropertyImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeLoanController extends Controller
{
    // Home Loan Application and EMI Calculator
    public function applyHomeLoan(Request $request)
    {

        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo"<pre>"; print_r($data); die;

            $homeloan = new HomeLoan;
            $homeloan->name                 = $data['name'];
            $homeloan->email                = $data['email'];
            $homeloan->phone                = $data['phone'];
            $homeloan->loan_amount          = $data['loan_amount'];
            $homeloan->loan_tenure          = $data['loan_tenure'];
            $homeloan->age                  = $data['your_age'];
            $homeloan->property_identify    = $data['property_identify'];
            $homeloan->property_city        = $data['property_city'];
            $homeloan->property_cost        = $data['property_cost'];
            $homeloan->occupation           = $data['occupation'];
            $homeloan->monthly_income       = $data['monthly_income'];
            $homeloan->total_emi            = $data['total_emi'];
            $homeloan->accept_condition     = $data['accept_condition'];

            $homeloan->save();
        
            return redirect()->back()->with('flash_message_success', 'Your Application for Home Loan Submitted Successfully!');
            
        }

        $footerProperties = Property::orderBy('created_at', 'desc')->limit(2)->get();
        $footerProperties = json_decode(json_encode($footerProperties));

        foreach($footerProperties as $key => $val) {
            $service_name = Services::where(['id'=>$val->service_id])->first();
            // $properties[$key]->service_name = $service_name->service_name;
            $propertyimage_name = PropertyImages::where(['property_id'=>$val->id])->first();
            $footerProperties[$key]->image_name = $propertyimage_name->image_name;
            $country = DB::table('countries')->where(['id'=>$val->country])->first();
            $footerProperties[$key]->country_name = $country->name;
            $state = DB::table('states')->where(['id'=>$val->state])->first();
            $footerProperties[$key]->state_name = $state->name;
            $city = DB::table('cities')->where(['id'=>$val->city])->first();
            $footerProperties[$key]->city_name = $city->name;
        }

        return view('frontend.home_loan_application', compact('footerProperties', 'country', 'state', 'city'));
    }

    // Home Loan Application
    public function homeLoanQuery()
    {
        $loanapplication = HomeLoan::orderBy('resolved', 'asc')->get();

        return view('admin.queries.home_loan_application', compact('loanapplication'));
    }

    // Home Loan Application Resolved
    public function applicationResolved(Request $request, $id=null)
    {
        if(!empty($id))
        {
            HomeLoan::where(['id'=>$id])->update(['resolved'=>1]);
            return redirect()->back()->with('flash_message_success', 'Application Status Changed Successfully!');
        }
    }

    // Home Loan Application Pending
    public function applicationPending(Request $request, $id=null)
    {
        if(!empty($id))
        {
            HomeLoan::where(['id'=>$id])->update(['resolved'=>0]);
            return redirect()->back()->with('flash_message_success', 'Application Status Changed Successfully!');
        }
    }
}
