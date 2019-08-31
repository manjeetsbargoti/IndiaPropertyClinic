@extends('layouts.frontLayout.frontend_design2')
@section('content')

@foreach($user_data as $ud)
<div class="smart_container">
    <div class="vender_profile">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="ven_leftside">
                        <div class="ven_propic">
                            <img src="{{ asset('/images/backend_images/user_images/user2.jpg') }}">
                        </div>
                        <div class="contact_details">
                            <ul>
                                <li><a
                                        href="tel:@if(!empty($ud->phonecode)){{ $ud->phonecode }}@endif @if(!empty($ud->phone)){{ $ud->phone }}@endif"><i
                                            class="fas fa-phone"> &nbsp;</i>@if(!empty($ud->phonecode))
                                        {{ $ud->phonecode }} @endif - @if(!empty($ud->phone)) {{ $ud->phone }}
                                        @endif</a></li>
                                <li>
                                    <i class="fas fa-address-card"></i> @if(!empty($ud->city_name))
                                    {{ $ud->city_name }}, @endif @if(!empty($ud->country_name)) {{ $ud->country_name }}
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a class="allphotos" href="#"> <i class="far fa-images"></i> See all 10 photos</a>
                </div>
                <div class="col-12 col-md-3 col-lg-6">
                    <div class="vender_content">
                        <h4>{{ $ud->first_name }} {{ $ud->last_name }}@if($ud->status == 1)<sup><img class="img-responsive" width="16" src="{{ url('/images/verified_badge.png') }}" alt="user verified badge"></sup>@endif</h4>
                        <div class="overview_rateingsec">
                            <h4 class="overview_rateing"><i class="staricon"><img
                                        src="../../images/frontend_images/images/star.svg">
                                </i><span class="autorate">4</span> / 5 </h4>
                            <a id="rateing_revbtn" href="javascript:void(0);">59,634 Ratings &amp; 10,710 Reviews</a>
                        </div>
                        @foreach(explode(',', $ud->servicetypeid) as $usid)
                        @foreach(\App\OtherServices::where('id', $usid)->get() as $r_service)
                        <!-- <p><a href="{{ url( '/services/'.$r_service->url ) }}">{{ $r_service->service_name }}</a></p> -->
                        @endforeach
                        @endforeach
                        <div class="vender_about">
                            <h5>About the @if(!empty($ud->user_type)){{ $ud->user_type }}@endif</h5>
                            <p>
                                Our goal is to be the best cleaning service in the San Francisco area by being
                                attentive, on time, professional and detailed. Our services provide Home Cleaning to any
                                place from a studio to large home.
                                We will make sure to take extra care of your home as if it is ours. We offer affordable
                                and reliable house cleaning services for studios, apartments, condos, houses, town
                                houses, offices. Whether you are moving out and need a one time deep clean, new
                                construction cleaning, after party cleaning or scheduled cleaning we will be here to
                                attend to your needs. We are flexible with your schedule to make sure your cleaning
                                needs are met within a timely manner whether our services are provided one time,
                                bi-monthly or on a monthly bases. Let us show you why our commitment to excellence
                                through great customer service and good work has kept our clients like family.
                            </p>
                        </div>

                        @if(!empty($ud->service_name))
                        <div class="vender_services">
                            <h5>Services Offered</h5>
                            <ul>
                                @foreach(explode(',', $ud->servicetypeid) as $usid)
                                @foreach(\App\OtherServices::where('id', $usid)->get() as $r_service)
                                <li><a
                                        href="{{ url( '/services/'.$r_service->url ) }}">{{ $r_service->service_name }}</a>
                                </li>
                                @endforeach
                                @endforeach
                            </ul>
                        </div>
                        @endif


                    </div>

                    <div id="rateing_rev" class="rateing_revsec">
                        <h4>59,634 Ratings &amp; 10,710 Reviews</h4>
                        <div class="rateing_revbox">
                            <div class="write_review">
                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="progressbar">
                                            <ul>
                                                <li>
                                                    <span class="progress_txt"><i class="staricon"><img
                                                                src="../../images/frontend_images/images/star.svg"></i>5</span>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped "
                                                            role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <strong>6010</strong>
                                                </li>
                                                <li>
                                                    <span class="progress_txt"><i class="staricon"><img
                                                                src="../../images/frontend_images/images/star.svg"></i>4</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <strong>4000</strong>
                                                </li>
                                                <li>
                                                    <span class="progress_txt"><i class="staricon"><img
                                                                src="../../images/frontend_images/images/star.svg"></i>3</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <strong>560</strong>
                                                </li>
                                                <li>
                                                    <span class="progress_txt"><i class="staricon"><img
                                                                src="../../images/frontend_images/images/star.svg"></i>2</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <strong>100</strong>
                                                </li>
                                                <li>
                                                    <span class="progress_txt"><i class="staricon"><img
                                                                src="../../images/frontend_images/images/star.svg"></i>1</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 10%" aria-valuenow="10" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <strong>40</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <button class="btn writerev_btn" data-toggle="modal" data-target="#ratingModal">
                                            Write a Reviews</button>
                                    </div>

                                </div>
                            </div>
                            <div class="rateing_list">
                                <ul>
                                    <li>
                                        <div class="revuser_profile">
                                            <img src="../../images/backend_images/user_images/user1.jpg">
                                        </div>
                                        <div class="rateing_listtxt">
                                            <h3 class="overview_rateinglist"><i class="staricon"><img
                                                        src="../../images/frontend_images/images/star.svg"></i><span
                                                    class="autorate">3.5</span> / 5 </h3>
                                            <h6>Nilanchi Kumari</h6>
                                            <p>India Property Clinic – Property portal and has been the most preferred
                                                property
                                                site in India,</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="vender_right">
                        <div class="req_quote">
                            <h5>Request a Quote</h5>
                            <ul>
                                <li>
                                    <h4>30 Min</h4>
                                    <p>Response Time</p>
                                </li>
                                <li>
                                    <h4>100%</h4>
                                    <p>Response Rate</p>
                                </li>
                            </ul>
                            <button type="button" data-target="#GetQuoteUser" data-toggle="modal"
                                class="btn btn-success btn-block mt-2 mb-2">Request a Quote</button>
                            <p>679 locals recently requested a quote</p>
                        </div>
                        <div class="appointment">
                            <h5>By appointment only</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Day</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Mon</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Tue</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Wed</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Thu</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Fri</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Sat</th>
                                        <td>8:00 am - 6:30 pm</td>
                                    </tr>
                                    <tr>
                                        <th>Sun</th>
                                        <td>Closed</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Get Quote Model -->
    <div class="modal fade" id="GetQuoteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GetQuote_user">Request A Quote</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Request Quote Form -->
                    <form method="post" action="{{ url('/profile/'.$ud->id.'/user') }}">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <select name="servicetype_req" id="RequiredService" class="form-control">
                                @foreach(\App\OtherServices::where('parent_id', 0)->get() as $rservice)
                                <option value="{{ $rservice->id }}">{{ $rservice->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea type="textarea" name="message" id="QuoteMessage" cols="8" class="form-control"
                                placeholder="Query..."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- /. Get Quote Model -->
</div>
@endforeach

@endsection