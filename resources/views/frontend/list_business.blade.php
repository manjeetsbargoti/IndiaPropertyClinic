@extends('layouts.frontLayout.frontend_design2')
@section('content')

<style>
.list_business_section {
    background-image: url('../../images/real-estate-bg.jpg');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    font-size: 1rem !important;
}

.list_business_section h2 {
    padding-top: 2em;
    text-align: center;
    color: #171747;
    font-size: 22px;
}

.list_business_section h3 {
    padding: 1em 0em;
    color: #171747;
    font-size: 20px;
}
</style>
<section class="list_business_section">

    <div class="vender_formsec">
        <div class="vender_header">
            <a class="backtohome" href="{{ url('/') }}">Back To Home</a>
        </div>
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <h2>List Your Business</h2>
                    <div class="mainform">
                        @if(Session::has('flash_message_success'))
                        <div class="alert alert-success alert-dismissible">
                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                        @endif
                        @if(Session::has('flash_message_error'))
                        <div class="alert alert-error alert-dismissible">
                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                            <strong>{!! session('flash_message_error') !!}</strong>
                        </div>
                        @endif

                        <form action="{{ url('/list-your-business') }}" method="POST" id="ListBusiness"
                            name="list_business">
                            {{ csrf_field() }}
                            <div class="row justify-content-md-center">
                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                    <label for="Select Service" class="title_txt">Select Services</label>
                                    <select name="offered_service" id="OfferedBService" class="form-control">
                                        <option value="" selected>-- Select a Service --</option>
                                        @foreach($repair_services as $rservice)
                                        <option value="{{ $rservice->id }}">{{ $rservice->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="BusinessInformation" class="d-none">
                                <h3>Business Information</h3>
                                <div class="row">
                                    <!-- Business Name -->
                                    <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                        <label class="title_txt">Business Name</label>
                                        <input type="text" id="ListBusinessName" name="business_name"
                                            class="form-control emptyformvalidation"
                                            placeholder="Enter your Business name">
                                        <br>
                                        <label class="title_txt">Experience</label>
                                        <input type="text" id="Experience" name="experience"
                                            class="form-control emptyformvalidation"
                                            placeholder="Enter your Experience">
                                    </div>
                                    <!-- Business Description -->
                                    <div class="form-group col-sm-6 col-md-8 col-lg-8">
                                        <label class="title_txt">Business Description</label> <span
                                            class="text-success">(max 500 words)</span>
                                        <textarea name="business_description" id="BuainessDescription"
                                            class="form-control" cols="30" rows="5" maxlength="500"
                                            placeholder="Write summery about your business..."></textarea>
                                    </div>
                                </div>

                                <h3>Business Location</h3>
                                <div class="row">
                                    <!-- Business Country -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label class="title_txt">Business Country</label>
                                        <select id="country" name="business_country"
                                            class="form-control emptyformvalidation">
                                            <option value="">-- Select Country --</option>
                                            @foreach($countries as $cont)
                                            <option value="{{ $cont->iso2 }}">{{ $cont->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Business State -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label class="title_txt">Business State</label>
                                        <select id="state" name="business_state"
                                            class="form-control emptyformvalidation">
                                            <option value="">-- Select State --</option>
                                        </select>
                                    </div>
                                    <!-- Business City -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <label class="title_txt">Business City</label>
                                        <select id="city" name="business_city" class="form-control emptyformvalidation">
                                            <option value="">-- Select City --</option>
                                        </select>
                                    </div>
                                </div>

                                <h3>Owner Information</h3>
                                <div class="row">
                                    <!-- Owner First Name -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <label class="title_txt">First Name</label>
                                        <input type="text" name="first_name" id="ListFBName" class="form-control"
                                            placeholder="Enter first name">
                                    </div>
                                    <!-- Owner Last Name -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <label class="title_txt">Last Name</label>
                                        <input type="text" name="last_name" id="ListLBName" class="form-control"
                                            placeholder="Enter last name">
                                    </div>
                                    <!-- Owner Email -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <label class="title_txt">Email</label>
                                        <input type="email" name="email" id="ListBEmail" class="form-control"
                                            placeholder="Enter email address">
                                    </div>
                                    <!-- Owner Phone -->
                                    <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-3">
                                        <label class="title_txt">Phone</label>
                                        <input type="text" name="phone" id="ListBPhone" class="form-control"
                                            placeholder="Enter phone number">
                                    </div>
                                </div>

                                <div class="row justify-content-lg-center">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <input style="float:none; display:block; margin:auto;" type="submit" class="btn btn-lg btn-info" value="Submit Business">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection