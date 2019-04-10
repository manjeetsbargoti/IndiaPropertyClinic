@extends('layouts.frontLayout.frontend_design')

@section('content')

<div class="smart_container">
    <div class="userlogin_form">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-dismissible">
                        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                    @endif
                    <div class="card w-50 border-secondary">
                        <div class="card-header">{{ __('Register') }}</div>
                            <div class="card-body">
                                <form id="registerForm" name="registerForm" action="{{ url('/register') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <select class="form-control" name="phonecode">
                                            @foreach($countrycode as $code)
                                            <option value="{{ $code->phonecode }}">{{ $code->iso3 }} &nbsp; {{ $code->phonecode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number">
                                    </div>
                                </div>
                                <label for="usertype"><strong>I am</strong></label>
                                <div class="form-group">
                                    @foreach($usertypes as $user)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usertype" id="usertype" value="{{ $user->usercode }}">
                                        <label class="form-check-label" for="usertype">{{ $user->usertype_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <label for="for vendor service"><strong>if you are a Vendor</strong></label>
                                <div class="form-group">
                                    <select class="form-control" name="servicetype">
                                        <option selected disabled>Select Service</option>
                                        @foreach($servicetype as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn submit_btn btn-block">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>                
                            </form>
                            <p>Already registered? <a href="{{ url('/login') }}">Login Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
