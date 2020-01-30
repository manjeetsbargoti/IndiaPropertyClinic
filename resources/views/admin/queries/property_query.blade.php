@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Property Queries</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Queries</li>
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
                                  <th>Type</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Query For</th>
                                  <th>Time</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($propertyquery as $pq)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $pq->usertype }}</td>
                                    <td>{{ $pq->name }}</td>
                                    <td>{{ $pq->email }}</td>
                                    <td>{{ $pq->phone }}</td>
                                    <td><a href="{{ $pq->queryfor }}" target="_blank">{{ $pq->queryforname }}</a></td>
                                    <td>{{ date('d M, Y', strtotime($pq->created_at)) }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#pq_{{ $pq->id }}" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-warning btn-xs">Edit</a>
                                        @if($pq->status == 1)
                                        <a href="{{ url('/admin/pending/'.$pq->id) }}" class="btn btn-success btn-xs">Done</a>
                                        @else
                                        <a href="{{ url('/admin/done/'.$pq->id) }}" class="btn btn-danger btn-xs">Pending</a>
                                        @endif
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
                            <tfoot>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Type</th>
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