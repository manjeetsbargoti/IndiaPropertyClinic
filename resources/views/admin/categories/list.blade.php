@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ $label }} Categories  <a href="{{ route('admin.categories.add') }}" class="btn btn-warning">Add Category</a> </h1><u><a href="{{ route('admin.categories') }}">All</a></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u><a href="{{ route('admin.categories', ['type' => 'trash']) }}">Trash</a></u>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{{ $label }} Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                        <strong>{!! session('success') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-error alert-dismissible">
                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                            <strong>{!! session('error') !!}</strong>
                        </div>
                    @endif
                    <div class="box box-danger">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="allusers-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($cats as $cat)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $cat->title }}</td>
                                        <td>
                                        <img src="{{ \App\Hash::image('images/backend_images/categories/', $cat->image) }}" class="thumb" style="width: 60px;">
                                        </td>
                                        <td><a href="{{url('/')}}/{{ $cat->slug }}" target="_blank">{{url('/')}}/{{ $cat->slug }}</a></td>
                                        <td>
                                        @if($cat->status==1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                        </td>
                                        <td>
                                            <div id="donate">
                                                @if($cat->deleted_at == null)
                                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                @if($cat->status==0)
                                                    <a href="{{ route('admin.categories.change-status', $cat->id) }}" class="btn btn-info btn-xs" title="Enable"><i class="fa fa-thumbs-up"></i></a>
                                                @else
                                                <a href="{{ route('admin.categories.change-status', $cat->id) }}" class="btn btn-info btn-xs" title="Disable"><i class="fa fa-thumbs-down"></i></a>
                                                @endif
                                                <a href="{{ route('admin.categories.delete', $cat->id) }}" class="btn btn-danger btn-xs" title="Delete" onclick = "if (! confirm('Are you sure. You want to delete this category?')) { return false; }"><i class="fa fa-trash"></i></a>
                                                @else
                                                <a href="{{ route('admin.categories.restore', $cat->id) }}" class="btn btn-success btn-xs" title="Delete">Restore</a>
                                                <a href="{{ route('admin.categories.force-delete', $cat->id) }}" class="btn btn-danger btn-xs" title="Delete" onclick = "if (! confirm('Are you sure. You want to delete this category permanentely?')) { return false; }"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Slug</th>
                                    <th>Status</th>
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