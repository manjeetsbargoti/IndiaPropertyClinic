@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Service Requests</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Service Request</li>
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
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Req. Service</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($service_request as $sr)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><strong>{{ $sr->name }}</strong></td>
                                    <td>{{ $sr->email }}</td>
                                    <td>{{ $sr->phone }}</td>
                                    <td><span class="label label-sm label-success">@if(!empty($sr->subs_service)) @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @endif</span></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#sr_{{ $sr->id }}" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-warning btn-xs">Edit</a>
                                        @if($sr->status == 1)
                                        <a href="{{ url('/admin/pending/'.$sr->id) }}" class="btn btn-success btn-xs">Done</a>
                                        @else
                                        <a href="{{ url('/admin/done/'.$sr->id) }}" class="btn btn-danger btn-xs">Pending</a>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="sr_{{ $sr->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><strong>Service Request for @if(!empty($sr->subs_service)) @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @endif</strong></h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-12">
                                                    <p><strong>Name:</strong> {{ $sr->name }}</p>
                                                    <p><strong>Email:</strong> <a href="mailto:{{ $sr->email }}">{{ $sr->email }}</a></p>
                                                    <h5><strong>Phone:</strong> <a href="tel:{{ $sr->phone }}">{{ $sr->phone }}</a></h5>
                                                    <p><strong>Requested Service:</strong> <a target="_blank" href="@if(!empty($sr->subs_service)) @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service) {{ url('/services/'.$r_service->url) }} @endforeach @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service) {{ url('/services/'.$r_service->url) }} @endforeach @endif">@if(!empty($sr->subs_service)) @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service) {{ $r_service->service_name }} @endforeach @endif</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Property information Model -->
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Query For</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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