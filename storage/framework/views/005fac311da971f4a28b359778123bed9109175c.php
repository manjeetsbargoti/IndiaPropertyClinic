<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/admin/users/edit_user.blade.php */ ?>
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add New User</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <?php if(Session::has('flash_message_success')): ?>
                      <div class="alert alert-success alert-dismissible">
                          <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                          <strong><?php echo session('flash_message_success'); ?></strong>
                      </div>
                  <?php endif; ?>
                  <?php if(Session::has('flash_message_error')): ?>
                      <div class="alert alert-error alert-dismissible">
                          <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                          <strong><?php echo session('flash_message_error'); ?></strong>
                      </div>
                  <?php endif; ?>
                  <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="edit_user" id="edit_user" method="POST" action="<?php echo e(url('/admin/edit-user/'.$userdetails->id)); ?>">
                    <?php echo e(csrf_field()); ?>

                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo e($userdetails->first_name); ?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo e($userdetails->last_name); ?>" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>E-mail</label>
                                  <input type="email" name="email" id="email" value="<?php echo e($userdetails->email); ?>" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xs-4 col-md-2">
                                <div class="form-group">
                                    <label>Code</label>
                                    <select name="phonecode" id="phonecode" class="form-control">
                                    <?php $__currentLoopData = $phonecode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code->phonecode); ?>"><?php echo e($code->phonecode); ?> &nbsp;<?php echo e($code->iso3); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                                <div class="form-group">
                                  <label>Phone</label>
                                  <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo e($userdetails->phone); ?>" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="Country">Country</label>
                                  <select name="country" id="country" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <?php echo $country_dropdown; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="State">State</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="state" id="state" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <?php echo $state_dropdown; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-xs-8 col-md-4">
                              <div class="form-group">
                                  <label for="City">City</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="city" id="city" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <?php echo $city_dropdown; ?>
                                  </select>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update User</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>