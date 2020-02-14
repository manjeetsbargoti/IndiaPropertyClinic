<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Country;
use App\Business;
use App\OtherServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    // Business List by Vendor
    public function categories(){
    	return view('frontend.blog.categories');
    }

    public function blog(){
    	return view('frontend.blog.blog');
    }

    public function singleBlog(){
    	return view('frontend.blog.single-blog');
    }
}