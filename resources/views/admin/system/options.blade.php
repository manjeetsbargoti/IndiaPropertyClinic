@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Options</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Options</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                  <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="site_options" id="site_options" method="POST" action="{{ url('/admin/options') }}">
                    {{ csrf_field() }}
                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Site Name</label>
                                  <input type="text" name="site_name" id="site_name" class="form-control" placeholder="Site Name" value="{{ config('app.name') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Site Url</label>
                                  <input type="text" name="site_url" id="site_url" class="form-control" placeholder="Site Url" value="{{ config('app.url') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Site Logo</label>
                                    <input type="file" name="site_logo" id="site_logo"  accept="image/*" class="form-control" placeholder="Site Logo">
                                    <div class="help-block">
                                        <span>Current: <a href="{{asset(config('app.logo'))}}" target="_blank"><i class="fa fa-external-link"></i></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Site Favicon</label>
                                    <input type="file" name="site_icon" id="site_icon" accept=".ico" class="form-control" placeholder="Site icon">
                                    <div class="help-block">
                                        <span>Current: <a href="{{asset(config('app.favicon'))}}" target="_blank"><i class="fa fa-external-link"></i></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection