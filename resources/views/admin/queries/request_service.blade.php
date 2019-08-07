@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Service Requests</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Request</li>
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
                                    <th>Assign to</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($service_request as $sr)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><strong><span
                                                style="font-family: 'Roboto'; color: orangered;">{{ $sr->name }}</span></strong>
                                    </td>
                                    <td>{{ $sr->email }}</td>
                                    <td>{{ $sr->phone }}</td>
                                    <td><span class="label label-sm label-success">@if(!empty($sr->subs_service))
                                            @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as
                                            $r_service) {{ $r_service->service_name }} @endforeach
                                            @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id',
                                            $sr->sub_service)->get() as $r_service) {{ $r_service->service_name }}
                                            @endforeach @elseif(!empty($sr->main_service)) @foreach(\App\OtherServices::where('id',
                                            $sr->main_service)->get() as $r_service) {{ $r_service->service_name }}
                                            @endforeach @endif</span></td>
                                    <td>@foreach(\App\User::where('id', $sr->assign_to)->get() as
                                        $vd) <a href="javascript:void()" data-toggle="modal"
                                            data-target="#vendor_{{$sr->assign_to}}">{{ str_limit($vd->first_name, $limit=25) }}</a>
                                        @endforeach</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#sr_{{ $sr->id }}"
                                            class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="modal" data-target="#assign_{{ $sr->id }}"
                                            class="btn @if(empty($sr->assign_to)) btn-warning @else btn-success @endif btn-xs">Assign</a>
                                        @if($sr->status == 1)
                                        <a href="{{ url('/admin/service/request/'.$sr->id.'/pending') }}"
                                            class="btn btn-success btn-xs">Done</a>
                                        @else
                                        <a href="{{ url('/admin/service/request/'.$sr->id.'/done') }}"
                                            class="btn btn-danger btn-xs">Pending</a>
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

    <!-- Property Information Model -->
    @foreach($service_request as $sr)
    <div class="modal fade bs-example-modal-lg" id="sr_{{ $sr->id }}" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Service Request for @if(!empty($sr->subs_service))
                            @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service)
                            {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service))
                            @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service)
                            {{ $r_service->service_name }} @endforeach @endif</strong></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{ $sr->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><a href="mailto:{{ $sr->email }}">{{ $sr->email }}</a></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td><a
                                            href="tel:@foreach(\App\Country::where('iso2', $sr->country)->get() as $cd) {{ $cd->phonecode }}@endforeach{{ $sr->phone }}">@foreach(\App\Country::where('iso2',
                                            $sr->country)->get() as $cd) {{ $cd->phonecode }}- @endforeach
                                            {{ $sr->phone }}</a></td>
                                </tr>
                                <tr>
                                    <td><strong>Requested Service</strong></td>
                                    <td><a target="_blank"
                                            href="@if(!empty($sr->subs_service)) @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service) {{ url('/services/'.$r_service->url) }} @endforeach @elseif(!empty($sr->sub_service)) @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service) {{ url('/services/'.$r_service->url) }} @endforeach @endif">@if(!empty($sr->subs_service))
                                            @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as
                                            $r_service)
                                            {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service))
                                            @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as
                                            $r_service)
                                            {{ $r_service->service_name }} @endforeach @endif</a></td>
                                </tr>
                                <tr>
                                    <td><strong>Project Status</strong></td>
                                    <td>{{ $sr->project_status }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Project Timeline</strong></td>
                                    <td>{{ $sr->project_timeline }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address Type</strong></td>
                                    <td>{{ $sr->address_type }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Are you Owner or Authorized</strong></td>
                                    <td>{{ $sr->ownership }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Interested in financing?</strong></td>
                                    <td>{{ $sr->financing }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td>{{ $sr->description }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{ $sr->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City, State, Country</strong></td>
                                    <td>@foreach(\App\Cities::where('id', $sr->city_name)->get() as
                                        $citydata){{ $citydata->name }},@endforeach @foreach(\App\State::where('id',
                                        $sr->state)->get() as
                                        $std) {{ $std->name }}, @endforeach @foreach(\App\Country::where('iso2',
                                        $sr->country)->get() as $cnt) {{ $cnt->name }} @endforeach</td>
                                </tr>
                                <tr>
                                    <td><strong>Assign to</strong></td>
                                    <td>@foreach(\App\User::where('id', $sr->assign_to)->get() as $vd)
                                        {{ str_limit($vd->first_name, $limit=25) }} @endforeach</td>
                                </tr>
                                <tr>
                                    <td><strong>Service Request Date</strong></td>
                                    <td>{{ date('d M, Y h:i:s A', strtotime($sr->created_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- /. Property information Model -->

    <!-- Assign Service to Vendor -->

    @foreach($service_request as $sr)
    <div class="modal fade bs-example-modal-lg" id="assign_{{ $sr->id }}" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #171747;"><strong>Assign Vendor for
                            @if(!empty($sr->subs_service))
                            @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service)
                            {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service))
                            @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service)
                            {{ $r_service->service_name }} @endforeach @endif in @foreach(\App\Cities::where('id',
                            $sr->city_name)->get() as $citydata){{ $citydata->name }}@endforeach,
                            {{ $sr->country }}</strong></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <form method="post" action="{{ url('/admin/service/request/'.$sr->id.'/assign') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="Vendor List">Service Provider in @foreach(\App\Cities::where('id',
                                    $sr->city_name)->get() as $citydata){{ $citydata->name }}@endforeach for
                                    @if(!empty($sr->subs_service))
                                    @foreach(\App\OtherServices::where('id', $sr->subs_service)->get() as $r_service)
                                    {{ $r_service->service_name }} @endforeach @elseif(!empty($sr->sub_service))
                                    @foreach(\App\OtherServices::where('id', $sr->sub_service)->get() as $r_service)
                                    {{ $r_service->service_name }} @endforeach @endif</label>
                                <select name="vendor_id" class="form-control" id="VendorList">
                                    <option value="" selected> -- Select Vendor -- </option>
                                    @foreach(\App\User::where('servicetypeid', $sr->main_service)->where('usertype',
                                    'V')->where('city', $sr->city_name)->get() as $userdata)
                                    <option value="{{ $userdata->id }}">{{ $userdata->first_name }}
                                        {{ $userdata->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-md" value="Assign">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- /. Assign Service to Vendor -->

    <!-- Vendor Infromation -->

    @foreach($service_request as $sr)
    @foreach(\App\User::where('id', $sr->assign_to)->get() as $user_info)
    <div class="modal fade bs-example-modal-lg" id="vendor_{{ $sr->assign_to }}" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #171747;">{{ $user_info->first_name }}
                        {{ $user_info->last_name }} | @foreach(\App\Cities::where('id', $user_info->city)->get() as
                        $ucity){{ $ucity->name }},@endforeach @foreach(\App\State::where('id', $user_info->state)->get()
                        as $ustate){{ $ustate->name }},@endforeach {{ $user_info->country }}</h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{ $user_info->first_name }} {{ $user_info->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><a href="mailto:{{ $user_info->email }}">{{ $user_info->email }}</a></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td><a
                                            href="tel:{{ $user_info->phonecode }}{{ $user_info->phone }}">{{ $user_info->phonecode }}-{{ $user_info->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Offered Service</strong></td>
                                    <td>@foreach(explode(',', $user_info->servicetypeid) as $ofsl)
                                        @foreach(\App\OtherServices::where('id', $ofsl)->get() as $rsername) <a
                                            href="{{ url('/services/'.$rsername->url) }}"
                                            class="label label-sm label-success">{{ $rsername->service_name }}</a>
                                        @endforeach @endforeach</td>
                                </tr>
                                <tr>
                                    <td><strong>Join on</strong></td>
                                    <td>{{ date('d M, Y h:i:s A', strtotime($user_info->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Location</strong></td>
                                    <td>@foreach(\App\Cities::where('id', $user_info->city)->get() as
                                        $ucity){{ $ucity->name }},@endforeach @foreach(\App\State::where('id',
                                        $user_info->state)->get() as $ustate){{ $ustate->name }},@endforeach
                                        {{ $user_info->country }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach

    <!-- /. Vendor Information -->

</div>
<!-- /.content-wrapper -->

@endsection