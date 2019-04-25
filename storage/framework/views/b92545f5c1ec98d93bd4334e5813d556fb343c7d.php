<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h3><a href="<?php echo e(url('admin/add-new-user')); ?>" class="label label-lg label-success">Add New</a></h3>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">All User</li>
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
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">List of All Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>E-mail Address</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Service</th>
                                    <th>Join Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></td>
                                    <td><?php echo e($u->email); ?></td>
                                    <td><?php echo e($u->phonecode); ?>-<?php echo e($u->phone); ?></td>
                                    <td><?php echo e($u->usertype_name); ?></td>
                                    <td>
                                    <?php if(!empty($u->service_name)): ?>
                                        <?php echo e($u->service_name); ?>

                                    <?php else: ?>
                                        Property
                                    <?php endif; ?>
                                    </td>
                                    <td><?php echo e(date('d M, Y', strtotime($u->created_at))); ?></td>
                                    <td>
                                        <div id="donate">
                                            <a href="/admin/edit-user/<?php echo e($u->id); ?>" tite="Edit" class="label label-warning label-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <?php if($u->status == 1): ?>
                                            <a href="/admin/udisable/<?php echo e($u->id); ?>" title="Disable" class="label label-danger label-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            <?php else: ?>
                                            <a href="/admin/uenable/<?php echo e($u->id); ?>" title="Enable" class="label label-success label-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>User Name</th>
                                    <th>E-mail Address</th>
                                    <th>Phone</th>
                                    <th>User Type</th>
                                    <th>Service</th>
                                    <th>Join Date</th>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/users/view_users.blade.php ENDPATH**/ ?>