<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Amenity</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Amenity</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="box box-success">
                    <!-- form start -->
                    <form role="form" name="add_amenity" id="add_amenity" method="POST"
                        action="<?php echo e(url('/admin/add-amenity')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Amenity Name</label>
                                        <span id="error_msg" class="pull-right"></span>
                                        <input type="text" name="amenity_name" id="amenity_name" class="form-control"
                                            placeholder="Amenity Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 hidden">
                                    <div class="form-group">
                                        <label>Amenity Code</label>
                                        <input type="text" name="amenity_code" id="amenity_code" class="form-control"
                                            placeholder="Amenity Code" value="<?php echo 'AM'.rand(1001, 9999); ?>">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="amenity_desc" class="form-control" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group">
                                        <label>Disable</label>
                                        <input type="checkbox" name="status" id="status" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button id="AddAmenity" type="submit" class="btn btn-success pull-right">Add Amenity</button>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/property/add_amenities.blade.php ENDPATH**/ ?>