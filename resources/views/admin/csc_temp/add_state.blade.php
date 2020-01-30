@extends('layouts.adminLayout.admin_design')
@section('content')

<style type="text/css">
.box {
    width: 600px;
    margin: 0 auto;
    border: 1px solid #ccc;
}

.has-error {
    border-color: #FF0000;
    background-color: #ffff99;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New State</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add State</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
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
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="add_state" id="add_state" method="POST"
                        action="{{ url('/admin/csc/state/add') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-8 col-md-4">
                                    <div class="form-group">
                                        <label for="Country">Country</label>
                                        <select name="country_id" id="country_id"
                                            class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="" selected>Select Country</option>
                                            @foreach($countryname as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-md-4">
                                    <div class="form-group">
                                        <label for="Country">Country iso2</label>
                                        <select name="country_iso2" id="country_iso2"
                                            class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="" selected>Select Country</option>
                                            @foreach($countryname as $c)
                                            <option value="{{ $c->iso2 }}">{{ $c->name }} [{{ $c->iso2 }}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-md-4">
                                    <div class="form-group">
                                        <label for="City">Sate</label>
                                        <input type="text" name="state_name" id="state_name" class="form-control"
                                            placeholder="Enter State Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Add State</button>
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