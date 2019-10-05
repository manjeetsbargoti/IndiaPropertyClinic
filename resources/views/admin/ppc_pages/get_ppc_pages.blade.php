@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="{{ url('admin/ppc/page/new') }}" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">PPC Pages</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Pages</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>PPC Type</th>
                                    <th>Service</th>
                                    <th>Template</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    @foreach($ppcPages as $p)
                                    <?php $i++ ?>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ url('/ipc/'.$p->url) }}" target="_blank">{{ $p->title }}</a></td>
                                    <td>{{ $p->ppc_type }}</td>
                                    <td>{{ $p->main_service }}</td>
                                    <td>{{ $p->template_design }}</td>
                                    <td>
                                        @if($p->status == 1)
                                            <a href="/admin/ppc/page/{{ $p->id }}/disable" title="Disable"
                                                class="label label-success label-sm">Publish</a>
                                        @else
                                            <a href="/admin/ppc/page/{{ $p->id }}/enable" title="Enable"
                                                class="label label-danger label-sm">Draft</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ url('/admin/ppc/page/'.$p->id.'/edit') }}" class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('/admin/ppc/page/'.$p->id.'/delete') }}" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
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