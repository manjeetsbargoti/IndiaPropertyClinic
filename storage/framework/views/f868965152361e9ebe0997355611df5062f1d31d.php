<?php $__env->startSection('content'); ?>

<!-- <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->

<style>
:root {
    --input-padding-x: 1.5rem;
    --input-padding-y: .75rem;
}

.login-form-body {
    background-image: url('../../bg-tan.webp');
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
    background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
    background-size: cover;
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
    width: 100%;
    margin-bottom: 0;
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

@media  all and (-ms-high-contrast: none),
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
                        <?php if(Session::has('flash_message_success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                            <strong><?php echo session('flash_message_success'); ?></strong>
                        </div>
                        <?php endif; ?>
                        <?php if(Session::has('flash_message_error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                            <strong><?php echo session('flash_message_error'); ?></strong>
                        </div>
                        <?php endif; ?>
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" name="userLoginForm" id="userLoginForm" method="post" action="<?php echo e(url('/login')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-label-group">
                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('email')); ?>" placeholder="Email address"
                                    required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="Password"
                                    required>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" name="remember" id="rememberCheck1" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                <label class="custom-control-label" for="rememberCheck1">Remember Password</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign
                                in</button>
                            <a class="d-block text-center mt-2 small" href="<?php echo e(url('/register')); ?>">Register</a>
                            <hr class="my-4">
                            <a class="btn btn-lg btn-twitter btn-block text-uppercase" id="twitter" href="<?php echo e(url('/auth/redirect/twitter')); ?>"><i
                                    class="fab fa-twitter mr-2"></i> Sign in with Twitter</a>
                            <a class="btn btn-lg btn-facebook btn-block text-uppercase" id="facebook" href="<?php echo e(url('/auth/redirect/facebook')); ?>"><i
                                    class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/auth/login.blade.php ENDPATH**/ ?>