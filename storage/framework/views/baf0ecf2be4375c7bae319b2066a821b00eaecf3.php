<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Options</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Options</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                  <div class="box box-success">
                    <!-- form start -->
                    <form method="POST" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                      <div class="box-body">
                        <div class="row">
                          <?php // echo $options; ?>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Site Name</label>
                                  <input type="text" name="site_name" id="site_name" class="form-control" placeholder="Site Name" value="<?php echo e(config('app.name')); ?>">
                                </div>
                            </div>  
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                  <label>Site Url</label>
                                  <input type="text" name="site_url" id="site_url" class="form-control" placeholder="Site Url" value="<?php echo e(config('app.url')); ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Site Logo</label>
                                    <input type="file" name="site_logo" id="site_logo"  accept="image/*" class="form-control" placeholder="Site Logo">
                                    <div class="help-block">
                                        <span><a href="<?php echo e(asset(config('app.logo'))); ?>" target="_blank"><img src="<?php echo e(asset(config('app.logo'))); ?>"></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label>Site Favicon</label>
                                    <input type="file" name="site_icon" id="site_icon" accept=".ico" class="form-control" placeholder="Site icon">
                                    <div class="help-block">
                                        <span><a href="<?php echo e(asset(config('app.favicon'))); ?>" target="_blank"><img src="<?php echo e(asset(config('app.favicon'))); ?>"></a></span>
                                    </div>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/system/options.blade.php ENDPATH**/ ?>