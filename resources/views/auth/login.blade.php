@extends('layouts.frontLayout.frontend_design2')
@section('content')
<style>
div.social-wrap a {
    padding-right: 35px;
    padding-top: 6px;
    text-align: center;
    height: 35px;
    vertical-align: middle;
    background: none;
    border: none;
    display: inline-block;
    background-size: 35px 35px;
    background-position: right center;
    background-repeat: no-repeat;
    border-radius: 4px;
    color: white;
    font-family: "Merriweather Sans", sans-serif;
    font-size: 14px;
    margin-bottom: 0px;
    width: 205px;
    border-bottom: 2px solid transparent;
    border-left: 1px solid transparent;
    border-right: 1px solid transparent;
    box-shadow: 0 4px 2px -2px grey;
    text-shadow: rgba(0, 0, 0, .5) -1px -1px 0;
}

div.social-wrap a#facebook {
    border-color: #2d5073;
    background-color: #3b5998;
    background-image: url(http://icons.iconarchive.com/icons/danleech/simple/512/facebook-icon.png);
}

div.social-wrap a#twitter {
    border-color: #007aa6;
    background-color: #008cbf;
    background-image: url(http://icons.iconarchive.com/icons/danleech/simple/512/twitter-icon.png);
}
</style>

<div class="smart_container">
    <div class="userlogin_form">
        <div class="container">
            <div class="row justify-content-center">
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
                        <div class="card-header">{{ __('Login') }}</div>
                        <div class="card-body">
                            <form name="userLoginForm" id="userLoginForm" method="post" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn submit_btn">
                                            {{ __('Login') }}
                                        </button>
                                        @if (Route::has('password.reset'))
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card w-50">
                        <div class="card-body">
                            <p>New to India Property Clinic <a href="{{ url('/register') }}">Sign Up</a></p>
                            <hr>
                            <div class="social-wrap">
                                <a href="{{ url('/auth/redirect/facebook') }}" id="facebook"> Sign in <em>w/</em>
                                    Facebook</a>&nbsp;&nbsp;<a href="{{ url('/auth/redirect/twitter') }}" id="twitter">
                                    Sign in <em>w/</em> Twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Facebook Like Popup Modal -->

<div class="modal fade" id="FbLikeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Like us on Facebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="fb-like" data-href="https://www.facebook.com/indiapropertyclinic/" data-width=""
                    data-layout="standard" data-action="like" data-size="large" data-show-faces="true"
                    data-share="true"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){ 
        // alert('Hello');
        $('#FbLikeModal').modal('toggle');
    }); 
</script>


@endsection