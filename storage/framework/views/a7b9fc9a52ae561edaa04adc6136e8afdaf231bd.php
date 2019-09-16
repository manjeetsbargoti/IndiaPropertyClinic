<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/add-phone-query')); ?>" class="label label-lg label-success">Add New</a></h3>
        <h1>Phone Queries</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Phone Queries</li>
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
                <div class="box box-purple">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Property Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $propertyquery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><label class="label label-md label-success"><?php echo e($pq->property_type); ?></label>
                                        <label class="label label-md label-info"><?php echo e($pq->property_for); ?></label></td>
                                    <td><?php echo e($pq->name); ?></td>
                                    <td><?php echo e($pq->email); ?></td>
                                    <td><?php echo e($pq->phone); ?></td>
                                    <td><?php if(!empty($pq->city)): ?> <?php $__currentLoopData = \App\Cities::where('id', $pq->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($c->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <?php if(!empty($pq->state)): ?>
                                        <?php $__currentLoopData = \App\State::where('id', $pq->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($s->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <?php echo e($pq->country); ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($pq->created_at))); ?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#pq_<?php echo e($pq->id); ?>" data-toggle="modal"
                                            class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-success btn-xs">Publish</a>
                                    </td>
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
<?php $__currentLoopData = $propertyquery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!-- Property Information Model -->
<div class="modal fade bs-example-modal-lg" id="pq_<?php echo e($pq->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="propertyView">
    <div class="modal-dialog" role="document">
        <div class="modal-content row">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo e($pq->name); ?> | Phone Property | <?php echo e($pq->usertype); ?>

                </h4>
            </div>
            <div class="modal-body col-sm-12">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Name</td>
                            <td><?php echo e($pq->name); ?></td>
                        </tr>
                        <tr>
                            <td>Usertype</td>
                            <td><?php echo e($pq->usertype); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo e($pq->email); ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo e($pq->phone); ?></td>
                        </tr>
                        <tr>
                            <td>Property Type</td>
                            <td><label class="label label-md label-success"><?php echo e($pq->property_type); ?></label>
                                <label class="label label-md label-info"><?php echo e($pq->property_for); ?></label></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><?php if(!empty($pq->city)): ?> <?php $__currentLoopData = \App\Cities::where('id', $pq->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($c->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <?php if(!empty($pq->state)): ?>
                                <?php $__currentLoopData = \App\State::where('id', $pq->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($s->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> <?php echo e($pq->country); ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?php echo $pq->description; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /. Property information Model -->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/queries/property_phone_query.blade.php ENDPATH**/ ?>