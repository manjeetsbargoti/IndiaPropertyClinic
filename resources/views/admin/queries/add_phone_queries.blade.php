@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Query</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Query</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="{{ url('/admin/add-phone-query') }}"
                            id="add_page" name="add_page" novalidate="novalidate">
                            {{ csrf_field() }}
                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label for="Person Name">Person Name</label>
                                            <input name="name" id="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Phone">Phone</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Phone</span>
                                                <input type="text" name="phone" id="phone" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Email Address">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Email</span>
                                                <input type="text" name="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Property For">Property For</label>
                                            <select name="property_for" id="property_for" class="form-control">
                                                <option value="" selected>Select Property For</option>
                                                <option value="Rent">Rent</option>
                                                <option value="Sale">Sale</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Property Type">Property Type</label>
                                            <select name="property_type" id="property_type" class="form-control">
                                                <option value="" selected>Select Property Type</option>
                                                @foreach(\App\PropertyTypes::where('status', 1)->orderBy('property_type', 'asc')->get() as $pt)
                                                    <option value="{{ $pt->property_type }}">{{ $pt->property_type }}</option>
                                                @endforeach
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
                                    <label for="Description">Address</label>
                                    <textarea name="address" id="address" class="form-control" ></textarea>
                                </div>
                                
                                
                                <div class="form-group" id="Country">
                                    <label for="Property For Country">Country</label>
                                    <select name="country_prop" id="country" class="form-control">
                                        <option value="" selected>Select Country</option>
                                        @foreach(\App\Country::get() as $cntry)
                                        <option value="{{ $cntry->iso2 }}">{{ $cntry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="State">
                                    <label for="Property For State">State</label>
                                    <select name="state_prop" id="state" class="form-control" data-placeholder="-- Select State --">
                                        <option value="" selected>Select State</option>
                                    </select>
                                </div>
                                <div class="form-group" id="City">
                                    <label for="Property For City">City</label>
                                    <select name="city_prop" id="city" class="form-control" data-placeholder="-- Select City --">
                                        <option value="" selected>Select City</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ZipCode">ZipCode</label>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="SubmitQuery" class="btn btn-info btn-block btn-md">Submit Query</button>
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