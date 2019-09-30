@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New Post</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Post</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/blog/post/new') }}"
                            id="add_page" name="add_page" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label for="Blog Title">Title</label>
                                            <input name="blog_title" id="blog_title" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Url">Url</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" name="slug" id="blog_slug" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Post Category">Post Category</label>
                                            <select name="blog_category" id="blog_category" class="form-control">
                                                <option value="1" selected>Category 1</option>
                                                <option value="2">Category 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="description" id="description" class="form-control my-editor"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="Post Type">Post Type</label>
                                    <select name="blog_type" id="blog_type" class="form-control">
                                        <option value="1" selected>Standard Post</option>
                                        <option value="2">Video Post</option>
                                    </select>
                                </div>
                                <div class="form-group" id="BlogTemplate">
                                    <label for="Template">Template Design</label>
                                    <select name="blog_template" id="blog_template" class="form-control">
                                        <option value="1" selected>Default (Full-width)</option>
                                        <option value="2">Left Sidebar</option>
                                        <option value="3">Right Sidebar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Blog Status">Status</label>
                                    <select name="blog_status" id="blog_status" class="form-control">
                                        <option value="1" selected>Publish</option>
                                        <option value="2">Draft</option>
                                    </select>
                                </div>
                                <div class="form-group" id="BlogPageCountry">
                                    <label for="Blog For Country">Country</label>
                                    <select name="blog_country" id="country" class="form-control">
                                        <option value="" selected>Select Country</option>
                                        @foreach(\App\Country::get() as $cntry)
                                        <option value="{{ $cntry->iso2 }}">{{ $cntry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="BlogPageState">
                                    <label for="Blog For State">State</label>
                                    <select name="blog_state" id="state" class="form-control" data-placeholder="-- Select State --">
                                        <option value="" selected>Select State</option>
                                    </select>
                                </div>
                                <div class="form-group" id="BlogPageCity">
                                    <label for="Blog For City">City</label>
                                    <select name="blog_city" id="city" class="form-control" data-placeholder="-- Select City --">
                                        <option value="" selected>Select City</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Feature Image">Feature Image</label>
                                    <input type="file" class="form-control" name="feature_image" id="FeatureImage">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="AddNewBlog" class="btn btn-success btn-block btn-md">Publish</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection