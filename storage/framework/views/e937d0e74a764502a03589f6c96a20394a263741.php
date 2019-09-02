<?php $__env->startSection('content'); ?>
<div class="smart_container">
    <div class="userlogin_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><?php echo e(__('Verify Email')); ?></div>

                        <div class="card-body">
                            <form name="verify_email_reset_password" id="VerifyEmailResetPassword" method="POST" action="<?php echo e(url('password/verify/email')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                            name="email" value="<?php echo e($email ?? old('email')); ?>" required>
                                        <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <?php echo e(__('Verify Email')); ?>

                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/auth/verify_email_for_reset_password.blade.php ENDPATH**/ ?>