@extends('layouts.frontLayout.frontend_design2')
@section('content')

<!-- <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->

<style>
:root {
    --input-padding-x: 1.5rem;
    --input-padding-y: .75rem;
}

.login-form-body {
    background-image: url('../../images/real-estate-bg.jpg');
    background-attachment: fixed; 
    background-repeat: no-repeat;
    background-position: center center; 
    background-size: cover;
    font-size: 1rem !important;
    /* background: linear-gradient(to right, #0062E6, #33AEFF); */
}
.login-form-body .btn {
    height: initial !important;
}

.card-signin {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card-signin .card-img-left {
    width: 45%;
    /* Link to your background image using in the property below! */
    background: scroll center url('../../images/reset-password.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-color: #f15a27;
}

.card-signin .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
}

.card-signin .card-body {
    padding: 2rem;
}

.form-signin {
    width: 100%;
}

.form-signin .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    transition: all 0.2s;
}

.form-label-group {
    position: relative;
    margin-bottom: 1rem;
}

.form-label-group input {
    height: auto;
    border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
    padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    /* width: 100%; */
    /* margin-bottom: 0; */
    /* Override default `<label>` margin */
    line-height: 1.5;
    color: #495057;
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
    color: transparent;
}

.form-label-group input:-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::-moz-placeholder {
    color: transparent;
}

.form-label-group input::placeholder {
    color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
    padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
    padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
    padding-top: calc(var(--input-padding-y) / 3);
    padding-bottom: calc(var(--input-padding-y) / 3);
    font-size: 10px;
    color: #777;
}

.btn-twitter {
    color: white;
    background-color: #38A1F3;
}

.btn-facebook {
    color: white;
    background-color: #3b5998;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
    .form-label-group>label {
        display: none;
    }

    .form-label-group input::-ms-input-placeholder {
        color: #F15A27;
    }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
    .form-label-group>label {
        display: none;
    }

    .form-label-group input:-ms-input-placeholder {
        color: #777;
    }
}
</style>

<section class="login-form-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
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
                        <h5 class="card-title text-center">{{ __('Verify Email') }}</h5>
                        <form name="verify_email_reset_password" id="VerifyEmailResetPassword" method="POST" action="{{ url('password/verify/email') }}">
                            {{ csrf_field() }}
                            <div class="form-label-group">
                                <span class="float-right" id="error_verifyemail"></span>
                                <input id="VerifyResetEmailPassword" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ $email ?? old('email') }}" onkeyup="verifyEmailBtnActivation()" required>
                                            
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                <label for="inputEmail"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" id="VerifyEmilReset" disabled type="submit">{{ __('Verify Email') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>

@endsection