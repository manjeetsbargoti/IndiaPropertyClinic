@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>View Repair Services</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">View Services</li>
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
                    <div class="box box-danger">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="allusers-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>S.No</th>
                                    <th>Services Banner</th>
                                    <th>Services Name</th>
                                    <th>Parent Service</th>
                                    @if(Auth::user()->admin == 1)
                                    <th>Status</th>
                                    <th>Action</th>
                                    @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($repairservices as $rservice)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                        @if(!empty($rservice->service_image))
                                            <img src="{{ asset('/images/backend_images/repair_service_images/large/'.$rservice->service_banner) }}" class="thumb" style="width: 60px;">
                                        @endif
                                        </td>
                                        <td><a href="{{url('/services/')}}/{{ $rservice->url }}" target="_blank">{{ $rservice->service_name }}</a></td>
                                        <td>{{ $rservice->parent_id }}</td>
                                        @if(Auth::user()->admin  == 1)
                                        <td>
                                        @if($rservice->status==1)
                                            <a href="/admin/rdisable/{{ $rservice->id }}" class="btn btn-success btn-sm">Enable</a>
                                        @else
                                            <a href="/admin/renable/{{ $rservice->id }}" class="btn btn-danger btn-sm">Disable</a>
                                        @endif
                                        </td>
                                        <td>
                                            <div id="donate">
                                                <a href=" {{ url('/admin/edit-repair-services/'.$rservice->id) }} " class="btn btn-warning btn-sm">Edit</a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
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