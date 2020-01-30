@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>PPC Queries</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">PPC Queries</li>
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
                                    <th>Main Service</th>
                                    <th>Location</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($ppcQuery as $pq)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $pq->name }}</td>
                                    <td>{{ $pq->email }}</td>
                                    <td>{{ $pq->phone }}</td>
                                    <td>{{ $pq->main_service }}</td>
                                    <td>{{ $pq->city }}, {{ $pq->state }}, {{ $pq->country }}</td>
                                    <td>{{ date('d M, Y', strtotime($pq->created_at)) }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#pq_{{ $pq->id }}" data-toggle="modal"
                                            class="btn btn-info btn-xs">info</a>
                                        <!--<a class="btn btn-success btn-xs">Publish</a>-->
                                    </td>
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
@foreach($ppcQuery as $pq)
<!-- Property Information Model -->
<div class="modal fade bs-example-modal-lg" id="pq_{{ $pq->id }}" tabindex="-1" role="dialog"
    aria-labelledby="propertyView">
    <div class="modal-dialog" role="document">
        <div class="modal-content row">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ $pq->name }} | PPC Query | {{ $pq->main_service }}
                </h4>
            </div>
            <div class="modal-body col-sm-12">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Name</td>
                            <td>{{ $pq->name }}</td>
                        </tr>
                        <tr>
                            <td>Main Service</td>
                            <td>{{ $pq->main_service }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $pq->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $pq->phone }}</td>
                        </tr>
                        <tr>
                            <td>Sub Service (2nd Level)</td>
                            <td>{{ $pq->sub_service }}</td>
                        </tr>
                        <tr>
                            <td>Sub Service (3rd Level)</td>
                            <td>{{ $pq->subs_service }}</td>
                        </tr>
                        
                        <tr>
                            <td>Location</td>
                            <td>{{ $pq->city }}, {{ $pq->state }}, {{ $pq->country }}</td>
                        </tr>
                        <tr>
                            <td>Query Message</td>
                            <td>{!! $pq->message !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. Property information Model -->
@endforeach

@endsection