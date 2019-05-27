@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>.htaccess</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">.htaccess</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                  <div class="box box-success">
                    <!-- form start -->
                    <form  enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>.htaccess</label>
                                  <textarea name="htaccess" id="htaccess" cols="30" rows="20" class="form-control">{!! $htaccess !!}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
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