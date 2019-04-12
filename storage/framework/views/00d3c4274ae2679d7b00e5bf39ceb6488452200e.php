<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/auth/register.blade.php */ ?>
<?php $__env->startSection('content'); ?>

<div class="smart_container">
    <div class="userlogin_form">
        <div class="container">
            <div class="row">
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
                        <div class="card-header"><?php echo e(__('Register')); ?></div>
                            <div class="card-body">
                                <form id="registerForm" name="registerForm" action="<?php echo e(url('/register')); ?>" method="post">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-row">
                                    <div class="form-group col-sm-6">
                                            <input id="first_name" type="text" class="form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" name="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First Name" required autofocus>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="form-group col-sm-6">
                                            <input id="last_name" type="text" class="form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name" required autofocus>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email Address" required>
                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="Password" required>
                                        <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <select class="form-control" name="phonecode">
                                            <?php $__currentLoopData = $countrycode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($code->phonecode); ?>"><?php echo e($code->iso3); ?> &nbsp; <?php echo e($code->phonecode); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <input type="text" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="Mobile Number">
                                    </div>
                                </div>
                                <label for="usertype"><strong>I am</strong></label>
                                <div class="form-group">
                                    <?php $__currentLoopData = $usertypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usertype" id="usertype" value="<?php echo e($user->usercode); ?>">
                                        <label class="form-check-label" for="usertype"><?php echo e($user->usertype_name); ?></label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <label for="for vendor service"><strong>if you are a Vendor</strong></label>
                                <div class="form-group">
                                    <select class="form-control" name="servicetype">
                                        <option selected disabled>Select Service</option>
                                        <?php $__currentLoopData = $servicetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($service->id); ?>"><?php echo e($service->service_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn submit_btn btn-block">
                                            <?php echo e(__('Register')); ?>

                                        </button>
                                    </div>
                                </div>                
                            </form>
                            <p>Already registered? <a href="<?php echo e(url('/login')); ?>">Login Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontLayout.frontend_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>