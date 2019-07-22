@extends('layouts.frontLayout.frontend_design2')
@section('content')

<div class="smart_container">
    <div class="services_viewsec">
        @foreach($services as $service)
        <div class="services_viewbanner" style="background-image:url('{{ url('images/backend_images/repair_service_images/large/'.$service->service_banner) }}')">
        @endforeach 
            <div class="overlay_services"></div>
            <div class="services_viewbannertxt">
                <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 col-xl-5">
                        <div class="header_breadcrumb white">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    @foreach($services as $service)
                                    <li class="breadcrumb-item active" aria-current="page">{{ $service->service_name }}</li>
                                    @endforeach
                                </ol>
                            </nav>
                        </div>
                        @foreach($services as $service)
                        <h1>{{ $service->service_name }}</h1>
                        @endforeach
                        <ul class="serliststyle">
                            @foreach($services as $service)
                            <li>{!! str_limit($service->s_description, $limit=400) !!}</li>
                            @endforeach
                        </ul>
                        <a href="#" role="button" class="btn btn-danger">Get Qute</a>
                        <a href="#" role="button" class="btn btn-warning">Call Now</a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-xl-4 ml-auto">
                        <div class="ser_prcessing">
                            <h4>What Services matter needs to be addressed?</h4>
                            <div class="ser_prcessinginn">
                                <?php $counter = 0; ?>
                                @foreach($sub_services as $sub_service)
                                <?php $counter ++; ?>
                                @if($counter <= 4)
                                <a href="{{ url('/services/'.$sub_service->url) }}">{{ $sub_service->service_name }}<i class="fas fa-angle-double-right"></i></a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="serview_container">
    <div class="container">
        <div id="ser_howitwork" class="serview_conbox">
            <div class="verticalser_listsec">
                
                <div class="row">
                <p><?php // echo print_r($sub_services); ?></p>
                    <div class="col-12 col-sm-4 col-xl-3">
                        <div class="accordion" id="cat">
                            <?php $counter = 0; ?>
                            @foreach($sub_services as $sub_service)
                            <?php $counter ++; ?>
                            <div class="accordion_outersec">
                                <!-- <div class="accordion_header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{ $sub_service->id }}" aria-expanded="true" aria-controls="collapseOne">
                                            
                                        </button>
                                    </h5>
                                </div> -->
                                <div class="accordion_header" id="headingOne">
                                    <h5 class="mb-0">
                                    <a href="{{ $sub_service->url }}">{{ $sub_service->service_name }}</a>
                                    <button class="arrowbtn" type="button" data-toggle="collapse" data-target="#collapse_{{ $sub_service->id }}" aria-expanded="true" aria-controls="collapseOne">

                                        @if(!empty($otherServices))
                                        <i class="fas fa-chevron-down"></i>
                                        @endif
                                    </button>
                                    </h5>
                                </div>
                                <div id="collapse_{{ $sub_service->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#cat">
                                    <div class="accordionbody">
                                        <ul class="sublist">
                                            @foreach($otherServices as $rservices)
                                            @if($rservices->parent_id == $sub_service->id)
                                                <li><a href="{{ $rservices->url }}">{{ $rservices->service_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach($services as $service)
                    <div class="col-12 col-sm-8 col-xl-9">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! $service->s_description !!}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                {!! $service->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>
        <!-- </div> -->
        <div class="related_product">
            <h5>Related Product</h5>
            <div class="row">
                @foreach($randervice as $service)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                    <div class="related_productbox">
                        <a href="{{ url('/services/'.$service->url) }}">
                            <div class="related_productboximg">
                                <img src="{{ url('images/frontend_images/images/dry-pipe.jpg') }}">
                            </div>
                            <h5> {{ $service->service_name }} </h5>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="ser_professionals" class="serview_conbox">
            <div class="row">
                @foreach(\App\User::where('usertype', 'V')->inRandomOrder()->take(4)->get() as $v)
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                    <a href="{{ url('/profile/'.$v->id.'/user') }}"><div class="fireman">
                        <div class="boxuser_pic">
                            <img src="{{ url('images/frontend_images/images/user2.jpg') }}">
                        </div>
                        <div class="boxuser_details">
                            <h5 style="overflow: hidden;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;">{{ $v->first_name }} {{ $v->last_name }}</h5>
                            <p>@foreach(\App\Cities::where('id', $v->city)->get() as $city){{ $city->name }}, @endforeach {{ $v->country }}</p>
                        </div>
                    </div></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection