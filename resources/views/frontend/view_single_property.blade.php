@extends('layouts.frontLayout.frontend_design2')
@section('content')

@foreach($properties as $property)
<div class="smart_container">
    <div class="property_viewsec">
        <div class="container">
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
                <div class="header_breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/properties') }}">Properties</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $property->property_name }}</li>
                        </ol>
                    </nav>
                    <p><span>@if(!empty($property->city_name)) {{ $property->city_name }},@endif <a href="{{ url('/country/'.$property->country.'/properties') }}">@if(!empty($property->country_name)) {{ $property->country_name }} @endif</a> </span> | All Residential for Sale in <a href="{{ url('/state/'.$property->state_name.'/properties') }}">@if(!empty($property->state_name)) {{ $property->state_name }} @endif</a> </p>
                </div>
            <div class="row">
            
            <div class="col-12 col-xl-8">
                    <div class="outer">
                    
                            <div id="big" class="owl-carousel owl-theme">
                                @foreach(\App\PropertyImages::where('property_id', $property->id)->get() as $pimage)
                                    <div class="item">
                                        <img style="max-height: 450px;" src="{{ asset('/images/backend_images/property_images/large/'.$pimage->image_name) }}" alt="{{ $property->property_name }}">
                                    </div>
                                @endforeach
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                @foreach(\App\PropertyImages::where('property_id', $property->id)->get() as $pimage)
                                    <div class="item">
                                        <img style="max-height: 100px;" src="{{ asset('/images/backend_images/property_images/large/'.$pimage->image_name) }}">
                                    </div>
                                @endforeach
                            </div>
                            
                            </div>
            </div>
           
            <div class="col-12 col-xl-4">
                <div class="overview_property">
                    <h1><i class="fas fa-map-marker-alt"></i> <a href="{{ url('/city/'.$property->city_name.'/properties') }}">@if(!empty($property->city_name)) {{ $property->city_name }},@endif @if(!empty($property->country_name)) {{ $property->country_name }} @endif</a></h1>
                    <h5>@if($property->parea)Plot Area: <span>{{ $property->parea }} Square Ft @endif</span></h5>
                    <h6>{{ $property->property_name }}</h6>
                    <!--<h5>Age of Property: <span>Under Construction</span></h5>-->
                    <h5>@if($property->pfacing)Facing: <span>{{ $property->pfacing }} @endif</span></h5>
                    
                    <p style="font-size: 14px; color: #171747; font-weight: 500;">{!! str_limit(strip_tags($property->description), $limit=350) !!}</p>
                    <!-- <h3>{{ $property->currency }} {{ $property->property_price }}</h3> -->
                    
                    @if(!empty($property->property_price))
                    <h3><span>{{ $property->currency }}</span> {{ $property->property_price }}</h3>
                    @else
                        <p><a href="javascript:avoid();" data-toggle="modal" data-target="#agentContact" class="btn_fullinfo">Get Price</a></p>
                    @endif
                    
                    <div class="protxt_top">
                        <ul>
                            <li><i><img src="/images/frontend_images/images/room.svg"></i><p><span>{{ $property->rooms }}</span>Rooms</p></li>
                            <li><i><img src="/images/frontend_images/images/bedroom.svg"></i><p><span>{{ $property->bedrooms }}</span>Bedrooms</p></li>
                            <li><i><img src="/images/frontend_images/images/bathroom.svg"></i><p><span>{{ $property->bathrooms }}</span>Bathroom</p></li>
                        </ul>
                    </div>
                    <div class="agent_sec">
                        <div class="agent_profile">
                            <!--<i class="fa fa-user fa-2x"></i>-->
                             <img class="img-responsive" src="/images/user.png">  
                        </div>
                        <div class="agent_txt">
                        @if(!empty($property->agent_name))
                        <h6><a href="{{ url('/profile/'.$property->agent.'/user') }}">{{ $property->agent_name }}</a>@if($property->status == 1) <sup><img class="img-responsive" width="16" src="{{ url('/images/verified_badge.png') }}" alt="user verified badge"></sup>@endif</h6>
                        @elseif(!empty($property->builder_name))
                        <h6><a href="{{ url('/profile/'.$property->builder.'/user') }}">{{ $property->builder_name }}</a>@if($property->status == 1) <sup><img class="img-responsive" width="16" src="{{ url('/images/verified_badge.png') }}" alt="user verified badge"></sup>@endif</h6>
                        @elseif(!empty($property->addby_name))
                        <h6><a href="{{ url('/profile/'.$property->add_by.'/user') }}">{{ $property->addby_name }}</a>@if($property->status == 1) <sup><img class="img-responsive" width="16" src="{{ url('/images/verified_badge.png') }}" alt="user verified badge"></sup>@endif</h6>
                        @endif
                        <a class="agent_contact" href="javascript:avoid();" data-toggle="modal" data-target="#agentContact">@if(!empty($property->agent_name))AGENT Contact @elseif(!empty($property->builder_name))Builder Name @elseif(!empty($property->addby_name))Request a Call @endif</a>
                        <a class="agent_contact contactbtn" href="javascript:avoid();" data-toggle="modal" data-target="#agentContact"><i class="fas fa-phone-volume"></i> View Mobile Number</a>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top: 1em;">
            <div class="sharethis-inline-share-buttons"></div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 mt-3 text-center">
            @include('admin.google_ads.partials.large_leaderboard_970_90')
        </div>
    </div>
    </div>

    <div class="spaceification_sec">
        <div class="container">
            <div class="row">
                <div class="col-12 xl-12 spaceification_secinn">
                    <div class="spaccei_tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @if($property->amenities)<li class="nav-item">
                                    <a class="nav-link @if(!empty($property->amenities)) active @endif" id="amenities-tab" data-toggle="tab" href="#amenities" role="tab" aria-controls="amenities" aria-selected="true">Amenities</a>
                                </li>@endif
                                <li class="nav-item">
                                    <a class="nav-link @if(empty($property->amenities)) active @endif" id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">Specifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Location</a>
                                </li>
                            </ul>
                            <div class="tab-content custom_tabcon" id="myTabContent">
                                @if(!empty($property->amenities))<div class="tab-pane fade @if(!empty($property->amenities)) show active @endif" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                                    <div class="amenities_item">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6 col-xl-12">
                                                <ul style="column-count:4;">
                                                    @foreach(explode(',', $property->amenities) as $amenity)
                                                    @foreach(\App\Amenity::where('amenity_code', $amenity)->get() as $am)
                                                    <li style="color: #171747; font-weight:500;font-family: Roboto; font-size: 14px;">{{ $am->name }}</li>
                                                    @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>    
                                        </div>
                                </div>@endif
                                <div class="tab-pane fade @if(empty($property->amenities)) show active @endif" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                                    <div class="spaceification_box">
                                        {!! $property->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="col-sm-6">
                                        <ul style="list-style: none;">
                                            <li><strong>Address:</strong> {{ $property->address1 }} {{ $property->address2 }}</li>
                                            <li><strong>Locality:</strong> {{ $property->locality }}</li>
                                            <li><strong>City:</strong> {{ $property->city_name }}</li>
                                            <li><strong>State:</strong> {{ $property->state_name }}</li>
                                            <li><strong>Country:</strong> {{ $property->country_name }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Properties -->

<div class="latest_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <!-- <div class="col-12 col-md-12 col-xl-12"> -->
                        <div class="col-12 col-sm-8 col-md-8 col-xl-8">
                            <div class="globleheadding text-left">
                                <h1>Related Property</h1>
                                <p>Find the latest homes for sale, property news & real estate market data </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-xl-4">
                            <div class="view_sec text-right">
                                <a class="btnview_all" href="{{ url('/properties') }}">View All</a>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <?php $counter = 0;?>
                    @foreach(\App\Property::where('service_id', $property->service_id)->where('country', $property->country)->where('state', $property->state)->orderBy('created_at', 'desc')->take(8)->get() as
                    $relproperty)
                    <?php $counter++;?>
                    @if($counter <= 8) <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                        <a href="{{ url('/properties/'.$relproperty->property_url) }}"><div class="product_box">
                            <div class="product_img">
                                <div class="owl-carousel product-slide owl-theme">
                                    @foreach(\App\PropertyImages::where('property_id', $relproperty->id)->get() as $pimage)
                                    <div class="item"><img class="img-fluid" style="max-height: 161px;" src="{{ asset('/images/backend_images/property_images/large/'.$pimage->image_name)}}" alt="{{ $relproperty->property_name }}">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="bottom_strip">
                                    <h6><i class="fas fa-map-marker-alt"></i>
                                        @if(!empty($relproperty->city))
                                        <span>@foreach(\App\Cities::where('id', $relproperty->city)->get() as $c)
                                            {{ $c->name }}, @endforeach</span>
                                        @endif
                                        @if(!empty($relproperty->country))
                                        <span>@foreach(\App\Country::where('iso2', $relproperty->country)->get() as $ct)
                                            {{ $ct->name }} @endforeach</span>
                                        @endif
                                    </h6>
                                    <p>@if($relproperty->parea){{ $relproperty->parea }} Square Ft @endif</p>
                                    @foreach(\App\Services::where('id', $relproperty->service_id)->get() as $pt)
                                    <span class="tagbtn rent">
                                        {{ $pt->service_name }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product_text">
                                <div class="protxt_top">
                                    <ul>
                                        <li><i><img src="/images/frontend_images/images/room.svg"></i>
                                            <p><span>{{ $relproperty->rooms }}</span>Rooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bedroom.svg"></i>
                                            <p><span>{{ $relproperty->bedrooms }}</span>Bedrooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bathroom.svg"></i>
                                            <p><span>{{ $relproperty->bathrooms }}</span>Bathroom</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="protxt_inn">
                                    <h6>{{ $relproperty->property_name }}</h6>
                                    <p>{{ str_limit(strip_tags($relproperty->description), $limit=100) }}</p>
                                    <div class="price_sec">
                                        <ul>
                                            <li>
                                                @if(!empty($relproperty->property_price))
                                                <h5><span>@if(!empty($relproperty->country))
                                                        @foreach(\App\Country::where('iso2', $relproperty->country)->get()
                                                        as $ct) {{ $ct->currency }} @endforeach
                                                        @endif</span> {{ $relproperty->property_price }}</h5>
                                                @else
                                                <a href="/properties/{{ $relproperty->property_url }}"
                                                    class="btn_fullinfo">Get Price</a>
                                                @endif
                                            </li>
                                            <!--<li><a href="{{ url('/properties/'.$relproperty->property_url) }}"-->
                                            <!--        class="btn_fullinfo">Full Info</a></li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- /. Related Properties -->

<!-- Agent/Builders in this Area -->

<div class="latest_product @if(\App\User::whereIn('usertype', array('A','B'))->where('country', $property->country)->where('state', $property->state)->count() == 0) d-none @endif">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="globleheadding text-left">
                            <h1>Builders/Agents in Same Area</h1>
                        </div>
                        <div class="dealers_sec">
                            <div class="owl-carousel dealerscarousel owl-theme">
                                @foreach(\App\User::whereIn('usertype', array('A','B'))->where('country', $property->country)->where('state', $property->state)->get() as $d)
                                <div class="item">
                                    <a href="{{ url('/profile/'.$d->id.'/user') }}">
                                        <div class="dealers_box">
                                            <div class="dealers_img"><img
                                                    src="/images/user.png"></div>
                                            <div class="dealers_txt">
                                                <h4>{{ $d->first_name }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /. Agent/Builders in this Area -->

        <div class="col-12 col-sm-12 col-md-12 mt-3 text-center">
            @include('admin.google_ads.partials.large_leaderboard_970_90')
        </div>

<!-- Modal Property Agent Contact -->
<div class="modal fade bd-example-modal-sm" id="agentContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agentModalCenterTitle">
                  Request Query
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/properties/'.$property->property_url) }}" name="agent_contact" id="agent_contact">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="I am.."><strong>I am..</strong></label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="Individual" selected>Individual</option>
                            <option value="Dealer">Dealer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input required type="text" name="name" id="name" class="form-control"  placeholder="Name*">
                    </div>
                    <div class="form-group">
                        <input required type="email" name="email" id="email" class="form-control" placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <input required type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number*">
                    </div>
                    <div class="form-group">
                        <input required type="hidden" name="queryforname" id="queryforname" class="form-control" value="{{ $property->property_name }}">
                    </div>
                    <div class="form-group">
                        <input required type="hidden" name="queryfor" id="queryfor" class="form-control" value="{{ url('/properties/'.$property->property_url) }}">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="1" name="accept_condition" id="accept_condition" required>
                        <label class="form-check-label" for="defaultCheck1">
                                I agree to be contacted by India Property Clinic and others for similar properties or related services
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn submit_btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Model Property Agent Contact end -->

@endforeach

@endsection