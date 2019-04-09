<?php /* D:\Laravel\PropertyAdmin\resources\views/admin/queries/property_query.blade.php */ ?>
<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Property Queries</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Queries</li>
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
                                  <th>Type</th>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Query For</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $propertyquery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($pq->usertype); ?></td>
                                    <td><?php echo e($pq->name); ?></td>
                                    <td><?php echo e($pq->email); ?></td>
                                    <td><?php echo e($pq->phone); ?></td>
                                    <td><a href="<?php echo e($pq->queryfor); ?>" target="_blank"><?php echo e($pq->queryforname); ?></a></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#pq_<?php echo e($pq->id); ?>" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-warning btn-xs">Edit</a>
                                        <?php if($pq->status == 1): ?>
                                        <a href="<?php echo e(url('/admin/pending/'.$pq->id)); ?>" class="btn btn-success btn-xs">Done</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(url('/admin/done/'.$pq->id)); ?>" class="btn btn-danger btn-xs">Pending</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="pq_<?php echo e($pq->id); ?>" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><?php echo e($pq->name); ?> | Property Query for <?php echo e($pq->queryforname); ?></h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-12">
                                                    <p><strong>Name:</strong> <?php echo e($pq->name); ?></p>
                                                    <p><strong>Type:</strong> <?php echo e($pq->usertype); ?></p>
                                                    <p><strong>Email:</strong> <?php echo e($pq->email); ?></p>
                                                    <h5><strong>Phone:</strong> <span style="color: #e60f0f;"><?php echo e($pq->phone); ?></span></h5>
                                                    <p><strong>Query For:</strong> <a target="_blank" href="<?php echo e($pq->queryfor); ?>"><?php echo e($pq->queryforname); ?></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Property information Model -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SR No.</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Query For</th>
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