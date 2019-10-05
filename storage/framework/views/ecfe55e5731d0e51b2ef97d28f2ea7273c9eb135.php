<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/ppc/page/new')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">PPC Pages</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Pages</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title</th>
                                    <th>PPC Type</th>
                                    <th>Service</th>
                                    <th>Template</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $ppcPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><a href="<?php echo e(url('/ipc/'.$p->url)); ?>" target="_blank"><?php echo e($p->title); ?></a></td>
                                    <td><?php echo e($p->ppc_type); ?></td>
                                    <td><?php echo e($p->main_service); ?></td>
                                    <td><?php echo e($p->template_design); ?></td>
                                    <td>
                                        <?php if($p->status == 1): ?>
                                            <a href="/admin/ppc/page/<?php echo e($p->id); ?>/disable" title="Disable"
                                                class="label label-success label-sm">Publish</a>
                                        <?php else: ?>
                                            <a href="/admin/ppc/page/<?php echo e($p->id); ?>/enable" title="Enable"
                                                class="label label-danger label-sm">Draft</a>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a href="<?php echo e(url('/admin/ppc/page/'.$p->id.'/edit')); ?>" class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/ppc/page/'.$p->id.'/delete')); ?>" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
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

<script>
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/ppc_pages/get_ppc_pages.blade.php ENDPATH**/ ?>