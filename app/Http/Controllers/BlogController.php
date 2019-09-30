<?php

namespace App\Http\Controllers;

use Image;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    // Add New Post
    public function addNewPost(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Repair Service image/icon
            if ($request->hasFile('feature_image')) {
                $image_tmp = Input::file('feature_image');
                if ($image_tmp->isValid()) {

                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = 'IPC_Page_' . rand(1, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/blog_images/large/' . $filename;
                    // Resize image
                    Image::make($image_tmp)->resize(1280, 720)->save($large_image_path);

                    // Store image in Services folder
                    // $rservices->service_image = $filename;
                }
            }

            if (!empty($filename)) {
                $filename = $filename;
            } else {
                $filename = '';
            }

            Blog::create([
                'title'             => $data['blog_title'],
                'url'               => $data['slug'],
                'content'           => $data['description'],
                'post_type'         => $data['blog_type'],
                'template'          => $data['blog_template'],
                'category'          => $data['blog_category'],
                'status'            => $data['blog_status'],
                'add_by'            => Auth::user()->id,
                'country'           => $data['blog_country'],
                'state'             => $data['blog_state'],
                'city'              => $data['blog_city'],
                'feature_image'     => $filename,
            ]);
            return redirect()->back()->with('flash_message_success','Blog Post Published!');
        }
        return view('admin.blog.add_new_post');
    }

    // View Blog Posts in Admin Panel
    public function returnBlogPost()
    {
        $posts = Blog::orderBy('created_at', 'desc')->get();

        return view('admin.blog.view_post', compact('posts'));
    }
}
