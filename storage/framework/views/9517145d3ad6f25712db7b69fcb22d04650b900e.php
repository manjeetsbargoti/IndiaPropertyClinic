<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Requested Quotes</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Quotes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
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
                                    <th>Query</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $req_quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($rq->name); ?></td>
                                    <td><?php echo e($rq->email); ?></td>
                                    <td><?php echo e($rq->phone); ?></td>
                                    <td>
                                        <?php $__currentLoopData = explode(',', $rq->req_service); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rqs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = \App\OtherServices::where('id', $rqs)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="label label-success label-sm"><?php echo e($r_service->service_name); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($rq->quote_message); ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($rq->created_at))); ?></td>
                                    <td>
                                        <?php if($rq->status == 1): ?>
                                        <a href="<?php echo e(url('/admin/req_quote/'.$rq->id.'/open')); ?>" class="btn btn-success btn-xs">Closed</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(url('/admin/req_quote/'.$rq->id.'/close')); ?>" class="btn btn-danger btn-xs">Open</a>
                                        <?php endif; ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/queries/requested_quotes.blade.php ENDPATH**/ ?>