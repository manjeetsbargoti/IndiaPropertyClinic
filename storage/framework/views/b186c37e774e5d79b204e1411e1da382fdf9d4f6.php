<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Contact info</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Contact info</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                  <div class="box box-success">
                    <!-- form start -->
                    <form method="POST" enctype="multipart/form-data" name="contact_details" id="ContactInfo">
                    <?php echo e(csrf_field()); ?>

                      <div class="box-body">
                        <div class="row">
                          <?php // echo $options; ?>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Email Address</label>
                                  <input type="email" name="email" id="email_address" class="form-control" placeholder="Email" value="<?php echo e(config('app.email')); ?>">
                                </div>
                            </div>  
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Phone Number</label>
                                  <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number" value="<?php echo e(config('app.phone')); ?>">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Address</label>
                                  <textarea name="address" id="address" rows="8" class="form-control"><?php echo e(config('app.address')); ?></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Copyright</label>
                                  <textarea name="copyright" id="copyright" class="form-control"><?php echo e(config('app.copyright')); ?></textarea>
                                </div>
                            </div>
                            
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/system/contact_info.blade.php ENDPATH**/ ?>