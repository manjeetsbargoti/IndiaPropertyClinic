@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="{{ url('admin/add-amenity') }}" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Amenities</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Amenities</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Amenity Code</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    @foreach($amenities as $am)
                                    <?php $i++ ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $am->name }}</td>
                                    <td>{{ $am->amenity_code}}</td>
                                    <td>{{ $am->description }}</td>
                                    <td>{{ date('d M, Y', strtotime($am->created_at)) }}</td>
                                    <td>
                                        <div id="donate">
                                            
                                            @if($am->status == 1)
                                            <a href="/admin/property/amenity/{{ $am->id }}/disable" title="Disable"
                                                class="label label-success label-sm">Enable</a>
                                            @else
                                            <a href="/admin/property/amenity/{{ $am->id }}/enable" title="Enable"
                                                class="label label-danger label-sm">Disable</a>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ url('/admin/property/amenity/'.$am->id.'/edit') }}" class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('/admin/property/amenity/'.$am->id.'/delete') }}" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
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

<script>
    
</script>

@endsection