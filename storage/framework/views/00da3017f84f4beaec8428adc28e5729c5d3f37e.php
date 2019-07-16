<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/add-amenity')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Amenities</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of Amenities</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Amenity Code</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $i = 0 ?>
                                    <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $am): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($am->name); ?></td>
                                    <td><?php echo e($am->amenity_code); ?></td>
                                    <td><?php echo e($am->description); ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($am->created_at))); ?></td>
                                    <td>
                                        <div id="donate">
                                            
                                            <?php if($am->status == 1): ?>
                                            <a href="/admin/amenity/<?php echo e($am->id); ?>/disable" title="Disable"
                                                class="label label-success label-sm">Enable</a>
                                            <?php else: ?>
                                            <a href="/admin/amenity/<?php echo e($am->id); ?>/enable" title="Enable"
                                                class="label label-danger label-sm">Disable</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="<?php echo e(url('/admin/amenity/'.$am->id.'/edit')); ?>" class="label label-warning label-sm"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo e(url('/admin/amenity/'.$am->id.'/delete')); ?>" class="label label-danger label-sm"><i class="fa fa-trash"></i></a>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/property/amenities.blade.php ENDPATH**/ ?>