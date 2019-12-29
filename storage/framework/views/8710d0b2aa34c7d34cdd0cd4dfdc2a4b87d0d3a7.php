<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/pages/new')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pages</li>
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
                                    <th>Page Type</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><a href="<?php echo e(url('/'.$p->url)); ?>" target="_blank"><?php echo e($p->title); ?></a></td>
                                    <td><?php if($p->page_type == 1): ?> Standard Page <?php elseif($p->page_type == 2): ?> Property Page <?php endif; ?></td>
                                    <td><?php $__currentLoopData = \App\User::where('id', $p->add_by)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                    <td>
                                        <div id="donate">
                                            
                                            <?php if($p->status == 1): ?>
                                            <a href="/admin/page/<?php echo e($p->id); ?>/disable" title="Disable"
                                                class="label label-success label-sm">Publish</a>
                                            <?php else: ?>
                                            <a href="/admin/page/<?php echo e($p->id); ?>/enable" title="Enable"
                                                class="label label-danger label-sm">Draft</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <td>
                                        <?php if(Auth::user()->admin  == 1): ?>
                                        <a href="<?php echo e(url('/admin/pages/'.$p->id.'/edit')); ?>" class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/page/'.$p->id.'/delete')); ?>" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
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

<script>
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/admin/pages/pages_all.blade.php ENDPATH**/ ?>