@extends('layouts.adminLayout.admin_design')
@section('content')

<style type="text/css">
   .box{width:600px;margin:0 auto;border:1px solid #ccc;}
   .has-error{border-color:#FF0000;background-color:#ffff99;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add New City</h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add City</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                  <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="add_city" id="add_city" method="POST" action="{{ url('/admin/csc/city/add') }}">
                    {{ csrf_field() }}
                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                              <div class="form-group">
                                  <label for="Country">Country iso2</label>
                                  <select name="country" id="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="" selected>Select Country</option>
                                      @foreach($countryname as $country)
                                      <option value="{{ $country->iso2 }}">{{ $country->name }} [{{ $country->iso2 }}]</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                              <div class="form-group">
                                  <label for="Country">Country Name</label>
                                  <select name="country_id" id="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="" selected>Select Country</option>
                                      @foreach($countryname as $country)
                                      <option value="{{ $country->id }}">{{ $country->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                              <div class="form-group">
                                  <label for="State">State</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="state" id="state" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="" selected>Select State</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                              <div class="form-group">
                                  <label for="City">City</label>
                                  <input type="text" name="city_name" id="city_name" class="form-control" placeholder="Enter City Name">
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Add City</button>
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