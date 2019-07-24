@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Requested Quotes</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Quotes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                                    <th>Req. Service</th>
                                    <th>Query</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($req_quotes as $rq)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $rq->name }}</td>
                                    <td>{{ $rq->email }}</td>
                                    <td>{{ $rq->phone }}</td>
                                    <td>
                                        @foreach(explode(',', $rq->req_service) as $rqs)
                                        @foreach(\App\OtherServices::where('id', $rqs)->get() as $r_service)
                                            <span class="label label-success label-sm">{{ $r_service->service_name }}</span>
                                        @endforeach
                                        @endforeach
                                    </td>
                                    <td>{{ $rq->quote_message }}</td>
                                    <td>
                                        @if($rq->status == 1)
                                        <a href="{{ url('/admin/req_quote/'.$rq->id.'/open') }}" class="btn btn-success btn-xs">Closed</a>
                                        @else
                                        <a href="{{ url('/admin/req_quote/'.$rq->id.'/close') }}" class="btn btn-danger btn-xs">Open</a>
                                        @endif
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

@endsection