@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="{{ url('admin/add-new-user') }}" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">All User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                                    <th>Service</th>
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
                                    <td>@if(!empty($u->phone)) {{$u->phonecode}}-{{ $u->phone}} @else <a href="/admin/edit-user/{{ $u->id }}" tite="Edit" class="label label-danger label-sm">Add Phone</a> @endif</td>
                                    <td>@if(!empty($u->usertype_name)) {{ $u->usertype_name }} @else User @endif</td>
                                    <td>
                                    @if(!empty($u->service_name))
                                        {{ $u->service_name }}
                                    @else
                                        Service
                                    @endif
                                    </td>
                                    <td>{{ date('d M, Y', strtotime($u->created_at)) }}</td>
                                    <td>
                                        <div id="donate">
                                            <a href="/admin/edit-user/{{ $u->id }}" tite="Edit" class="label label-warning label-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            @if($u->status == 1)
                                            <a href="/admin/udisable/{{ $u->id }}" title="Disable" class="label label-danger label-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            @else
                                            <a href="/admin/uenable/{{ $u->id }}" title="Enable" class="label label-success label-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                            @endif
                                            <a href="/admin/delete-user/{{ $u->id }}" tite="Delete" class="label label-danger label-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                                    <th>Service</th>
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