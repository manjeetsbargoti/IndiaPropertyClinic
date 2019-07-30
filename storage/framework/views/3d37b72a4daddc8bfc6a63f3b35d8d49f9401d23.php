<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Service Requests</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Service Request</li>
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
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Req. Service</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $service_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><strong><?php echo e($sr->name); ?></strong></td>
                                    <td><?php echo e($sr->email); ?></td>
                                    <td><?php echo e($sr->phone); ?></td>
                                    <td><span class="label label-sm label-success"><?php if(!empty($sr->subs_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></span></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#sr_<?php echo e($sr->id); ?>" data-toggle="modal" class="btn btn-info btn-xs">info</a>
                                        <a class="btn btn-warning btn-xs">Edit</a>
                                        <?php if($sr->status == 1): ?>
                                        <a href="<?php echo e(url('/admin/pending/'.$sr->id)); ?>" class="btn btn-success btn-xs">Done</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(url('/admin/done/'.$sr->id)); ?>" class="btn btn-danger btn-xs">Pending</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="sr_<?php echo e($sr->id); ?>" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><strong>Service Request for <?php if(!empty($sr->subs_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></strong></h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-12">
                                                    <p><strong>Name:</strong> <?php echo e($sr->name); ?></p>
                                                    <p><strong>Email:</strong> <a href="mailto:<?php echo e($sr->email); ?>"><?php echo e($sr->email); ?></a></p>
                                                    <h5><strong>Phone:</strong> <a href="tel:<?php echo e($sr->phone); ?>"><?php echo e($sr->phone); ?></a></h5>
                                                    <p><strong>Requested Service:</strong> <a target="_blank" href="<?php if(!empty($sr->subs_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(url('/services/'.$r_service->url)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(url('/services/'.$r_service->url)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>"><?php if(!empty($sr->subs_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></a></p>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/queries/request_service.blade.php ENDPATH**/ ?>