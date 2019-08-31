<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>View Repair Services</h1>
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
                                    <th>Services Banner</th>
                                    <th>Services Name</th>
                                    <th>Parent Service</th>
                                    <?php if(Auth::user()->admin == 1): ?>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $repairservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td>
                                        <?php if(!empty($rservice->service_image)): ?>
                                            <img src="<?php echo e(asset('/images/backend_images/repair_service_images/large/'.$rservice->service_banner)); ?>" class="thumb" style="width: 60px;">
                                        <?php endif; ?>
                                        </td>
                                        <td><a href="<?php echo e(url('/services/')); ?>/<?php echo e($rservice->url); ?>" target="_blank"><?php echo e($rservice->service_name); ?></a></td>
                                        <td><?php echo e($rservice->parent_id); ?></td>
                                        <?php if(Auth::user()->admin  == 1): ?>
                                        <td>
                                        <?php if($rservice->status==1): ?>
                                            <a href="/admin/rdisable/<?php echo e($rservice->id); ?>" class="btn btn-success btn-sm">Enable</a>
                                        <?php else: ?>
                                            <a href="/admin/renable/<?php echo e($rservice->id); ?>" class="btn btn-danger btn-sm">Disable</a>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <div id="donate">
                                                <a href=" <?php echo e(url('/admin/edit-repair-services/'.$rservice->id)); ?> " class="btn btn-warning btn-sm">Edit</a>
                                            </div>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/repair_services/view_repair_service.blade.php ENDPATH**/ ?>