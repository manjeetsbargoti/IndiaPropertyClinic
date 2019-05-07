@extends('layouts.adminLayout.admin_design')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Recent Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Properties</span>
              <span class="info-box-number"><?php echo $property_count; ?></small></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Home Loan Query</span>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Total &nbsp;&nbsp;<?php echo $homeloan_total_count; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Pending &nbsp;&nbsp;<?php echo $homeloan_pen_count; ?></label></a>
            </div>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-help"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Property Query</span>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Total &nbsp;&nbsp;<?php echo $propertyq_total_count; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Pending &nbsp;&nbsp;<?php echo $propertyq_pen_count; ?></label></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <a href="{{ url('/admin/users') }}" class="user-count"><label class="btn btn-info btn-xs">Total &nbsp;&nbsp;<?php echo $contUser; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Active &nbsp;&nbsp;<?php echo $contActUser; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Inactive &nbsp;&nbsp;<?php echo $contInactUser; ?></label></a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Property</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php $counter = 0 ; ?>
                @foreach($property as $p)
                <?php $counter++ ; ?>
                @if( $counter <= 4)
                <li class="item">
                  <div class="product-img"><span class="label label-info">{{ date('d M, Y', strtotime($p->created_at)) }} </span>
                    <img style="width: 67px !important;" class="img-responsive" src="{{ asset('/images/backend_images/property_images/large/'.$p->image_name)}}" alt="{{ $p->property_name }}">
                  </div>
                  <div class="product-info">
                    <a href="{{ url('/properties/') }}/{{ $p->property_url }}" target="_blank" class="product-title">{{ str_limit($p->property_name, $limit=50) }}
                    <span class="label label-success pull-right">@if(!empty($p->currency)){{ $p->currency }} @endif {{ $p->property_price }}</span>
                    <span class="product-description">{{ strip_tags(str_limit($p->description, $limit=100)) }}</span>
                  </div>
                </li>
                @endif
                @endforeach
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ url('/admin/properties') }}" class="uppercase">View All Proerty</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <div class="col-md-5">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Members</h3>
              <div class="box-tools pull-right">
                <span class="label label-success">New Members</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                <?php $counter = 0 ; ?>
                @foreach($users as $u)
                <?php $counter++ ; ?>
                @if( $counter <= 8)
                <li>
                  <img title="{{ $u->first_name }} {{ $u->last_name }}" src="../../dist/img/user1-128x128.jpg" alt="{{ $u->first_name }} Image">
                  <a title="{{ $u->first_name }} {{ $u->last_name }}" class="users-list-name" href="#">{{ $u->first_name }} {{ $u->last_name }}</a>
                  <!-- <span class="users-list-date">{{ $u->created_at }}</span> -->
                  @if($u->status == 1)
                  <a href="/admin/disable/{{ $u->id }}" class="label label-success">Active</a>
                  @else
                  <a href="/admin/enable/{{ $u->id }}" class="label label-danger">Inactive</a>
                  @endif
                </li>
                @endif
                @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ url('/admin/users') }}" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Option</h3>
              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                  <i class="fa fa-comments"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection