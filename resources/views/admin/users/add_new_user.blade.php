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
      <h1>Add New User</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                  <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="add_new_user" id="add_new_user" method="POST" action="{{ url('/admin/add-new-user') }}">
                    {{ csrf_field() }}
                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>E-mail</label> <span class="pull-right" id="error_email"></span>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-2">
                                <div class="form-group">
                                    <label>Code</label>
                                    <select name="phonecode" id="phonecode" class="form-control">
                                    @foreach($phonecode as $code)
                                        <option value="{{ $code->phonecode }}">{{ $code->phonecode }} &nbsp;{{ $code->iso3 }}</option>
                                    @endforeach    
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                                <div class="form-group">
                                  <label>Phone</label> <span class="pull-right" id="error_phone"></span>
                                  <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="Country">Country</label>
                                  <select name="country" id="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="" selected>Select Country</option>
                                      @foreach($countryname as $count)
                                      <option value="{{ $count->iso2 }}">{{ $count->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="State">State</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="state" id="state" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="" selected>Select State</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="City">City</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="city" id="city" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <option value="" selected>Select City</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" name="password" id="generatePassword" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                  <button style="margin-top: 2.25em;" type="button" class="btn btn-info btn-sm" onclick='document.getElementById("generatePassword").value = Password.generate(16)'>Generate Password</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sx-12 col-md-6">
                              <label>User Type</label>
                              <div class="form-group">
                                <select name="usertype" class="form-control" id="usertype">
                                    <option value="" selected>Select Usertype</option>
                                  @foreach($usertype as $type)
                                    <option value="{{ $type->usercode }}">{{ $type->usertype_name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <!-- <div class="col-sx-12 col-md-6">
                              <label>User Type</label>
                              <div class="form-group">
                                <select name="usertype" class="form-control" id="usertype">
                                    <option value="" selected>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                    <option value="2">Seo</option>
                                </select>
                              </div>
                            </div> -->
                            <div class="col-xs-12 col-md-6" id="vendorService">
                                <label for="for vendor service"><strong>if you are a Vendor</strong></label>
                                <div class="form-group">
                                    <select class="form-control select2" name="servicetype[]" id="servicetype" multiple="multiple" data-placeholder="Select Service Type">
                                        @foreach($servicetype as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Add User</button>
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