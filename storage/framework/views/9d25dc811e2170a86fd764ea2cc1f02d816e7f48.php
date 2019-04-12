<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/admin/services/view_services.blade.php */ ?>
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>View Services</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">View Services</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                    <div class="box box-danger">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="allusers-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>S.No</th>
                                    <th>Services Image</th>
                                    <th>Services Name</th>
                                    <th>Parent Service</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td>
                                        <?php if(!empty($service->service_image)): ?>
                                            <img src="<?php echo e(asset('/images/backend_images/service_images/large/'.$service->service_image)); ?>" class="thumb" style="width: 60px;">
                                        <?php endif; ?>
                                        </td>
                                        <td><?php echo e($service->service_name); ?></td>
                                        <td><?php echo e($service->parent_id); ?></td>
                                        <td><a href="<?php echo e(url('/')); ?>/<?php echo e($service->url); ?>" target="_blank"><?php echo e(url('/')); ?>/<?php echo e($service->url); ?></a></td>
                                        <td>
                                        <?php if($service->status==1): ?>
                                            <button class="btn btn-success btn-mini">Enable</button>
                                        <?php else: ?>
                                            <button class="btn btn-danger btn-mini">Disable</button>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <div id="donate">
                                                <button class="btn btn-warning btn-sm">Edit</button>
                                                <?php if($service->status==0): ?>
                                                    <a href="/admin/enable/<?php echo e($service->id); ?>" class="btn btn-success btn-sm">Enable</a>
                                                <?php else: ?>
                                                <a href="/admin/disable/<?php echo e($service->id); ?>" class="btn btn-danger btn-sm">Disable</a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Services Image</th>
                                        <th>Services Name</th>
                                        <th>Parent Service</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>