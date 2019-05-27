<?php $__env->startSection('content'); ?>
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
                    <div class="card w-50 border-secondary">
                        <div class="card-header"><?php echo e(__('Login')); ?></div>
                            <div class="card-body">
                                <form name="userLoginForm" id="userLoginForm" method="post" action="<?php echo e(url('/login')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                                            <?php if($errors->has('email')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                                            <?php if($errors->has('password')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                                <label class="form-check-label" for="remember">
                                                    <?php echo e(__('Remember Me')); ?>

                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn submit_btn">
                                                <?php echo e(__('Login')); ?>

                                            </button>
                                            <?php if(Route::has('password.reset')): ?>
                                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">
                                                    <?php echo e(__('Forgot Your Password?')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card w-50">
                            <div class="card-body">
                            <p>New to India Property Clinic <a href="<?php echo e(url('/register')); ?>">Sign Up</a></p>
                            <hr>
                            <div class="social-wrap">
                                <a href="<?php echo e(url('/auth/redirect/facebook')); ?>" id="facebook"> Sign in <em>w/</em> Facebook</a>&nbsp;&nbsp;<a href="<?php echo e(url('/auth/redirect/twitter')); ?>" id="twitter"> Sign in <em>w/</em> Twitter</a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\IndiaPropertyClinic\resources\views/auth/login.blade.php ENDPATH**/ ?>