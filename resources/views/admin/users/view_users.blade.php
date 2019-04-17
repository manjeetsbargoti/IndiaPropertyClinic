@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>All User</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">All User</li>
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
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of All Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>E-mail Address</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Join Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php $i = 0 ?>
                                @foreach($user as $u)
                                <?php $i++ ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                                    <td>{{ $u->email}}</td>
                                    <td>{{$u->phonecode}}-{{ $u->phone}}</td>
                                    <td>{{ $u->usertype_name }}</td>
                                    <td>{{ date('d M, Y', strtotime($u->created_at)) }}</td>
                                    <td>
                                        <div id="donate">
                                            <a href="/admin/edit-user/{{ $u->id }}" class="label label-warning label-sm">Edit</a>
                                            @if($u->status == 1)
                                            <a href="/admin/disable/{{ $u->id }}" class="label label-danger label-sm">Deactivate</a>
                                            @else
                                            <a href="/admin/enable/{{ $u->id }}" class="label label-success label-sm">Activate</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>E-mail Address</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Join Date</th>
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