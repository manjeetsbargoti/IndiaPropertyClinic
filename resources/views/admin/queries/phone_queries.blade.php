@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h3><a href="{{ url('admin/add-phone-query') }}" class="label label-lg label-success">Add New</a></h3>
      <h1>Phone Queries</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Phone Queries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                <div class="box box-purple">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                  <th>SR No.</th>
                                  <th>Property Type</th>
                                  <th>Person Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Location</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($phoneQueries as $pq)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><label class="label label-md label-success">{{ $pq->property_type }}</label> <label class="label label-md label-info">{{ $pq->property_for }}</label></td>
                                    <td>{{ $pq->name }}</td>
                                    <td>{{ $pq->email }}</td>
                                    <td>{{ $pq->phone }}</td>
                                    <td>@if(!empty($pq->city)) @foreach(\App\Cities::where('id', $pq->city)->get as $city) {{ $city->name }}, @endforeach @endif @if(!empty($pq->state)) @foreach(\App\State::where('id', $pq->state)->get as $state) {{ $state->name }}, @endforeach @endif {{ $pq->country }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#pq_{{ $pq->id }}" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="pq_{{ $pq->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">{{ $pq->name }} | Property Query for {{ $pq->queryforname }}</h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-12">
                                                    <p><strong>Name:</strong> {{ $pq->name }}</p>
                                                    <p><strong>Type:</strong> {{ $pq->usertype }}</p>
                                                    <p><strong>Email:</strong> {{ $pq->email }}</p>
                                                    <h5><strong>Phone:</strong> <span style="color: #e60f0f;">{{ $pq->phone }}</span></h5>
                                                    <p><strong>Query For:</strong> <a target="_blank" href="{{ $pq->queryfor }}">{{ $pq->queryforname }}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Property information Model -->
                                @endforeach
                            </tbody>
                        </table>
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