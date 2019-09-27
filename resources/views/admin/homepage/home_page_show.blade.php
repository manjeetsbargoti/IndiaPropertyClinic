@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Ads Management</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Ads Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                  <div class="box box-success">
                    <!-- form start -->
                    <form  enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Home Page Content</label>
                                  <textarea name="home_page_content" id="home_page_content" cols="30" rows="7" class="form-control my-editor">{!! $home_page_content !!}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
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