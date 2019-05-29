@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Sitemap</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Sitemap</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box box-success">
                    <!-- form start -->
                    <form enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Number of links in Sitemap</label>
                                        <input type="text" class="form-control" name="sitemap_links" id="sitemap_links"
                                            value="{{ config('sitemap_links') }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Sitemap Create at</label>
                                        <input type="time" class="form-control" name="sitemap_created_at"
                                            id="sitemap_created_at" value="<?php echo date('H:i:s'); ?>">
                                        <div class="help-block">
                                            <span>Last Created at: {{ config('sitemap_created_at') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label>Add Properties?</label>
                                        <select name="sitemap_add_properties" id="sitemap_add_properties" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Add Properties?</label>
                                        <br>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_properties" id="" value="1"
                                                    @if(config('sitemap_add_properties')) checked @endif> Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_properties" id="" value="0"
                                                    @if(!config('sitemap_add_properties')) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Add Repair Services?</label>
                                        <br>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_services" id="" value="1"
                                                    @if(config('sitemap_add_services')) checked @endif> Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_services" id="" value="0"
                                                    @if(!config('sitemap_add_services')) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Add Categories?</label>
                                        <br>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_categories" id="" value="1"
                                                    @if(config('sitemap_add_categories')) checked @endif> Yes
                                            </label>
                                        </div>
                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" name="sitemap_add_categories" id="" value="0"
                                                    @if(!config('sitemap_add_categories')) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <a href="{{url('/admin')}}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info" name="submit" value="0">Submit</button>
                                <button type="submit" class="btn btn-success" name="submit" value="1">Submit and
                                    Generate</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection