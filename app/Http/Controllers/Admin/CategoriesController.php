<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoriesController extends Controller
{

    public function index(Request $request){

        if($request->has('type') && $request->input('type') == 'trash'){
            $cats = Category::onlyTrashed()->orderBy('id', 'desc')->get();
            $label = 'Trashed';
        }else{
            $cats = Category::orderBy('id', 'desc')->get();
            $label = 'All';
        }

        return view('admin.categories.list', ['cats' => $cats, 'label' => $label]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug'  =>  'required|unique:categories'
        ]);
    }

    public function add(Request $request){

        if($request->isMethod('post')){

            // $slug = Category::createSlug($request->title);
            // $request['slug'] = $slug;
            $this->validator($request->all())->validate();

            $post = request()->except(['_token']);

            if(isset($request->image)){                
                $file = $request->file('image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('images/backend_images/categories'), $imageName); 
                $post['image'] = $imageName;
            }else{
                unset($post['image']);
            }

            $insert = Category::create($post);
            if($insert){
                return redirect()->route('admin.categories')->with('success','Category has been created successfully!');
            } else {
                return back()->with('error','Error in adding Category');
            }
        }

        return view('admin.categories.add');
    }

    public function edit(Request $request, $id){

        $cat = Category::where('id', $id)->first();

        if($request->isMethod('post')){

            $post = request()->except(['_token']);

            // if(trim(strtolower($post['title'])) != trim(strtolower($cat->title))){
            //     $post['slug'] = Category::createSlug($post['title']);
            // }else{
            //     $post['slug'] = $cat->slug;
            // }

            Validator::make($post, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug'  =>  'nullable|unique:categories,slug,'.$cat->id
            ])->validate();

            if(isset($request->image)){    
                    
                if($cat->image != ''){
                    if(file_exists(public_path('/backend_images/categories/'.$cat->image))){
                        unlink(public_path('/backend_images/categories/'.$cat->image));
                    }
                }
                
                $file = $request->file('image');
                $imageName = time().$file->getClientOriginalName();
                $upload = $file->move(public_path('backend_images/categories'), $imageName); 
                $post['image'] = $imageName;
            }

            if(!isset($post['status'])){
                $post['status'] = 0;
            }

            $update = Category::where('id', $id)->update($post);

            if($update){
                return redirect()->route('admin.categories')->with('success','Category has been updated successfully!');
            } else {
                return back()->with('error','Error in updating Category');
            }

        }

        return view('admin.categories.edit', ['cat' => $cat]);
    }

    public function changeStatus($id){
        $cat = Category::where('id', $id)->first();
        $update = Category::where('id', $id)->update(['status' => $cat->status == 1 ? '0' : '1']);
        return redirect()->back()->with('success', 'Status has been updated successfully!');
    }

    public function delete($id)
    {
        $cat = Category::find($id);
        if($cat->image != ''){
            if(file_exists(public_path('/backend_images/categories/'.$cat->image))){
                unlink(public_path('/backend_images/categories/'.$cat->image));
            }
        }
        
        $delete = Category::where('id', $id)->delete();
        if($delete){
            return redirect(route('admin.categories'))->with('success','Category moved to tash!');
        } else {
            return redirect(route('admin.categories'))->with('error','Error in deleting category');
        }
    }

    public function getSlug(Request $request){
        $slug = Category::createSlug($request->title);
        return response()->json(array('status'=> true, 'slug' => $slug), 200);
    }

    public function restore($id){
        Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restored successfully');
    }

    public function forceDelete($id){
        $category = Category::withTrashed()->find($id);

        if($category->image != ''){
            if(file_exists(public_path('/backend_images/categories/'.$category->image))){
                unlink(public_path('/backend_images/categories/'.$category->image));
            }
        }

        $category->forceDelete();
        return redirect()->back()->with('success','Category deleted successfully');
    }

}