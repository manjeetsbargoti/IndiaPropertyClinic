@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Home Loan Application</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Application</li>
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
                                  <th>City</th>
                                  <th>Loan Amount</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($loanapplication as $loan)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $loan->name }}</td>
                                    <td>{{ $loan->email }}</td>
                                    <td>{{ $loan->phone }}</td>
                                    <td>{{ $loan->property_city }}</td>
                                    <td>{{ $loan->loan_amount }}/-</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#loan_{{ $loan->id }}" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-warning btn-xs">Edit</a>
                                        @if($loan->resolved == 1)
                                        <a href="{{ url('/admin/pending/'.$loan->id) }}" class="btn btn-success btn-xs">Resolved</a>
                                        @else
                                        <a href="{{ url('/admin/resolved/'.$loan->id) }}" class="btn btn-danger btn-xs">Pending</a>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="loan_{{ $loan->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">{{ $loan->name }} | Home Loan Application</h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-12">
                                                    <p><strong>Name:</strong> {{ $loan->name }}</p>
                                                    <p><strong>Email:</strong> {{ $loan->email }}</p>
                                                    <h5><strong>Phone:</strong> <span style="color: #e60f0f;">{{ $loan->phone }}</span></h5>
                                                    <p><strong>Loan Amount:</strong> {{ $loan->loan_amount }}/-</p>
                                                    <p><strong>City:</strong> {{ $loan->city }}/-</p>
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
                                    <th>City</th>
                                    <th>Loan Amount</th>
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