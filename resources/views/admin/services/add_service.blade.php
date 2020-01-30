@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add Property Services</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add Services</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="box box-info">
                  @if(Session::has('flash_message_success'))
                      <div class="alert alert-success alert-dismissible">
                          <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                          <strong>{!! session('flash_message_success') !!}</strong>
                      </div>
                  @endif
                  @if(Session::has('flash_message_error'))
                      <div class="alert alert-error alert-dismissible">
                          <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                          <strong>{!! session('flash_message_error') !!}</strong>
                      </div>
                  @endif
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/service/new') }}" id="add_service" name="add_service" novalidate="novalidate">
                      {{ csrf_field() }}
                        <div class="row">
                          <div class="col-xs-12 col-md-6">
                              <div class="form-group">
                                  <label for="Service Name">Service Name</label>
                                  <input name="service_name" id="service_name" type="text" class="form-control">
                                </div>
                          </div>
                          <div class="col-xs-12 col-md-6">
                              <div class="form-group">
                                  <label>Service Level</label>
                                  <select name="parent_id" id="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="0" selected="selected">Main Service</option>
                                    @foreach($levels as $val)
                                      <option value="{{ $val->id }}">{{ $val->service_name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Url</span>
                            <input name="service_url" id="service_url" type="text" class="form-control">
                          </div>
                      </div>

                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" id="description" class="form-control my-editor"></textarea>
                        </div>
                        <!-- <div class="form-group">
                          <label>
                              <input type="checkbox" class="minimal-red"> Repairing Service
                          </label>
                        </div> -->

                        <div class="form-group">
                          <label>
                              <input type="checkbox" value="1" name="status" id="status" class="minimal-red"> Enable
                          </label>
                        </div>
                        
                        <div class="form-group">
                          <label for="Service Image">File input</label>
                          <input type="file" name="service_image" id="service_image" class="form-control-file">
                          <p class="help-block">Example block-level help text here.</p>
                        </div>
                        
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success btn-md pull-right">Submit</button>
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