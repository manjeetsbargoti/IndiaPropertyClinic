@extends('layouts.adminLayout.admin_design')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Listed Property</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">View Property</li>
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
                                    <th>Id</th>
                                    <th>Property Image</th>
                                    <th>Property Name</th>
                                    <th>Service Name</th>
                                    <th>Location</th>
                                    <th>Property Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($properties as $property)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    @if(!empty($property->image_name))
                                    <td><img width="60px" class="thumb"
                                            src="{{ asset('/images/backend_images/property_images/large/'.$property->image_name)}}">
                                    </td>
                                    @else
                                    <td><img width="60px" class="thumb"
                                            src="{{ asset('/images/backend_images/property_images/large/default.jpg')}}">
                                    </td>
                                    @endif
                                    <td><a target="_blank"
                                            href="{{ url('/properties/'.$property->property_url) }}">{{ $property->property_name }}</a>
                                    </td>
                                    <td><span class="label label-md label-success">{{ $property->service_name }}</span>
                                    </td>
                                    <td>@if(!empty($property->city))@foreach(\App\Cities::where('id',
                                        $property->city)->get() as $city){{ $city->name }},@endforeach @endif
                                        @if(!empty($property->country))@foreach(\App\Country::where('iso2',
                                        $property->country)->get() as $country){{ $country->name }} @endforeach @endif
                                    </td>
                                    <td>@if($property->property_price){{ $property->currency }}
                                        {{ $property->property_price }}@endif</td>
                                    <td>
                                        <a data-target="#property_{{ $property->id }}" data-toggle="modal"
                                            title="Detail" class="btn btn-success btn-xs"><i class="fa fa-info-circle"
                                                aria-hidden="true"></i></a>
                                        @if(Auth::user()->admin == 1)
                                        <a href="{{ url('/admin/property/'.$property->id.'/edit') }}" title="Edit"
                                            class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i></a>
                                        <a href="{{ url('/admin/property/'.$property->id.'/delete') }}" title="Delete"
                                            class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                aria-hidden="true"></i></a>
                                        @endif
                                    </td>
                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info_1" id="allusers-table_info_1" role="status" aria-live="polite">
                                Showing 1 to 10 of 10 entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers_1" id="allusers-table_paginate_1">
                                {!! $properties->render() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Property Information Model -->
    @foreach($properties as $property)
    <div class="modal fade bd-example-modal-lg" id="property_{{ $property->id }}" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $property->property_name }} by
                        {{ $property->user_fname }} {{ $property->user_lname }}</h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-4">
                        @if(!empty($property->image_name))
                        <img width="320" class="img-responsive"
                            src="{{ asset('/images/backend_images/property_images/large/'.$property->image_name)}}">
                        @else
                        <img width="320" class="img-responsive"
                            src="{{ asset('/images/backend_images/property_images/large/default.jpg')}}">
                        @endif
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Reference Code</td>
                                    <td>{{ $property->property_code }}</td>
                                </tr>
                                <tr>
                                    <td>Property Name</td>
                                    <td>{{ $property->property_name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td><strong>@if($property->property_price){{ $property->currency }}
                                            {{ $property->property_price }}@endif</strong></td>
                                </tr>
                                <tr>
                                    <td>Property For</td>
                                    <td><label
                                            class="label label-md label-success">{{ $property->service_name }}</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Add By</td>
                                    <td><a href="javascript:void()" data-target="#userinfo_{{ $property->user_id }}"
                                            data-toggle="modal">{{ $property->user_fname }}
                                            {{ $property->user_lname }}</a></td>
                                </tr>
                                <tr>
                                    <td>Posted on</td>
                                    <td>{{ date('d M, Y h:i:s A', strtotime($property->created_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Property Url</td>
                                    <td><a href="{{ url('/propreties/'.$property->property_url) }}"
                                            target="_blank">{{ url('/propreties/'.$property->property_url) }}</a></td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><label class="label label-md label-info">@foreach(\App\PropertyTypes::where('property_type_code', $property->property_type_id)->get() as $pt){{ $pt->property_type }} @endforeach</label></td>
                                </tr>
                                <tr>
                                    <td>Featured Property</td>
                                    <td>@if($property->featured == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Commercial Property</td>
                                    <td>@if($property->commercial == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Property Area (in sqft.)</td>
                                    <td>@if(!empty($property->parea)){{ $property->parea }} sqft. @endif</td>
                                </tr>
                                <tr>
                                    <td>Property Facing</td>
                                    <td>{{ $property->pfacing }}</td>
                                </tr>
                                <tr>
                                    <td>Transection Type</td>
                                    <td>{{ $property->transection_type }}</td>
                                </tr>
                                <tr>
                                    <td>Construction Status</td>
                                    <td>{{ $property->construction_status }}</td>
                                </tr>
                                <tr>
                                    <td>Builder</td>
                                    <td><a href="javascript:void()" data-target="#builderinfo_{{ $property->builder_id }}"
                                            data-toggle="modal">{{ $property->builder_fname }} {{ $property->builder_lname }}</a></td>
                                </tr>
                                <tr>
                                    <td>Agent</td>
                                    <td><a href="javascript:void()" data-target="#agentinfo_{{ $property->agent_id }}"
                                            data-toggle="modal">{{ $property->agent_fname }} {{ $property->agent_lname }}</a></td>
                                </tr>
                                <tr>
                                    <td>Road Facing</td>
                                    <td>@if($property->road_facing == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Corner Shop</td>
                                    <td>@if($property->c_shop == 1) Yes @else No @endif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Map Passed</td>
                                    <td>@if($property->map_pass == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Open Sides</td>
                                    <td>{{ $property->open_sides }}</td>
                                </tr>
                                <tr>
                                    <td>Bedrooms</td>
                                    <td>{{ $property->bedrooms }}</td>
                                </tr>
                                <tr>
                                    <td>Bathrooms</td>
                                    <td>{{ $property->bathrooms }}</td>
                                </tr>
                                <tr>
                                    <td>Balconies</td>
                                    <td>{{ $property->balconies }}</td>
                                </tr>
                                <tr>
                                    <td>Furnish Type</td>
                                    <td>{{ $property->furnish_type }}</td>
                                </tr>
                                <tr>
                                    <td>Floor no.</td>
                                    <td>{{ $property->floorno }}</td>
                                </tr>
                                <tr>
                                    <td>Total Floors</td>
                                    <td>{{ $property->total_floors }}</td>
                                </tr>
                                @if($property->property_type_id == 1019)
                                <tr>
                                    <td>Apple Trees</td>
                                    <td>{{ $property->apple_trees }}</td>
                                </tr>
                                @endif
                                @if($property->commercial == 1)
                                <tr>
                                    <td>Personal Washroom</td>
                                    <td>@if($property->p_washrooms == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Cafeteria</td>
                                    <td>@if($property->cafeteria == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <td>Personal Showroom</td>
                                    <td>@if($property->p_showroom == 1) Yes @else No @endif</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Wall Made</td>
                                    <td>@if($property->wall_made == 1) Yes @else No @endif</td>
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

    <!-- User Modal -->
    @foreach($properties as $property)
    @foreach(\App\User::where('id',$property->user_id)->get() as $userinfo)
    <div class="modal fade bd-example-modal-md" id="userinfo_{{ $property->user_id }}" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $property->user_fname }} {{ $property->user_lname }}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="{{ url('/dist/img/user2-160x160.jpg') }}"
                                alt="{{ $userinfo->first_name }}">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $userinfo->first_name }} {{ $userinfo->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $userinfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $userinfo->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td>@if($userinfo->admin == 1) Admin @else {{ $userinfo->usertype }} @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td>{{ $userinfo->business_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td>{{ $userinfo->about_business }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>@if(!empty($userinfo->country)) @foreach(\App\Country::where('iso2',$userinfo->country)->get() as $country){{ $country->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>@if(!empty($userinfo->state)) @foreach(\App\State::where('id',$userinfo->state)->get() as $state){{ $state->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>@if(!empty($userinfo->city)) @foreach(\App\Cities::where('id',$userinfo->city)->get() as $city){{ $city->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td>{{ date('d M, Y h:i:s A', strtotime($userinfo->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
    <!-- /. User Modal -->
    <!-- Agent Modal -->
    @foreach($properties as $property)
    @foreach(\App\User::where('id',$property->agent_id)->get() as $userinfo)
    <div class="modal fade bd-example-modal-md" id="agentinfo_{{ $property->agent_id }}" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $property->agent_fname }} {{ $property->agent_lname }}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="{{ url('/dist/img/user2-160x160.jpg') }}"
                                alt="{{ $userinfo->first_name }}">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $userinfo->first_name }} {{ $userinfo->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $userinfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $userinfo->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td>@if($userinfo->admin == 1) Admin @else {{ $userinfo->usertype }} @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td>{{ $userinfo->business_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td>{{ $userinfo->about_business }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>@if(!empty($userinfo->country)) @foreach(\App\Country::where('iso2',$userinfo->country)->get() as $country){{ $country->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>@if(!empty($userinfo->state)) @foreach(\App\State::where('id',$userinfo->state)->get() as $state){{ $state->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>@if(!empty($userinfo->city)) @foreach(\App\Cities::where('id',$userinfo->city)->get() as $city){{ $city->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td>{{ date('d M, Y h:i:s A', strtotime($userinfo->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
    <!-- /. Agent Modal -->

    <!-- Builder Modal -->
    @foreach($properties as $property)
    @foreach(\App\User::where('id',$property->builder_id)->get() as $userinfo)
    <div class="modal fade bd-example-modal-md" id="builderinfo_{{ $property->builder_id }}" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ $property->builder_fname }}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="{{ url('/dist/img/user2-160x160.jpg') }}"
                                alt="{{ $userinfo->first_name }}">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $userinfo->first_name }} {{ $userinfo->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $userinfo->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $userinfo->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td>@if($userinfo->admin == 1) Admin @else {{ $userinfo->usertype }} @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td>{{ $userinfo->business_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td>{{ $userinfo->about_business }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>@if(!empty($userinfo->country)) @foreach(\App\Country::where('iso2',$userinfo->country)->get() as $country){{ $country->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>@if(!empty($userinfo->state)) @foreach(\App\State::where('id',$userinfo->state)->get() as $state){{ $state->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>@if(!empty($userinfo->city)) @foreach(\App\Cities::where('id',$userinfo->city)->get() as $city){{ $city->name }}@endforeach @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td>{{ date('d M, Y h:i:s A', strtotime($userinfo->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
    <!-- /. Builder Modal -->

</div>
<!-- /.content-wrapper -->

<style>
.dataTables_info,
.paging_simple_numbers {
    display: none;
}

.pagination {
    margin: 10px 20px 20px 0px;
    float: right;
}

.dataTables_info_1 {
    margin: 20px;
}
</style>

@endsection