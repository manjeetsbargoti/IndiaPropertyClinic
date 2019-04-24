<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Listed Property</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Property</li>
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
                                  <th>Property Id</th>
                                  <th>Property Image</th>
                                  <th>Property Name</th>
                                  <th>Service Name</th>
                                  <th>Property Code</th>
                                  <th>Property Price</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <?php if($propertyimage_count > 0): ?>
                                    <td><img width="60px" class="thumb" src="<?php echo e(asset('/images/backend_images/property_images/large/'.$property->image_name)); ?>"></td>
                                    <?php else: ?>
                                    <td><img width="60px" class="thumb" src="<?php echo e(asset('/images/backend_images/property_images/large/default.jpg')); ?>"></td>                                    
                                    <?php endif; ?>
                                    <td><a target="_blank" href="<?php echo e(url('/properties/'.$property->property_url)); ?>"><?php echo e($property->property_name); ?></a></td>
                                    <td><?php echo e($property->service_name); ?></td>
                                    <td><?php echo e($property->property_code); ?></td>
                                    <td><?php echo e($property->property_price); ?>/-</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#property_<?php echo e($property->id); ?>" data-toggle="modal" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        <a href="<?php echo e(url('/admin/edit-property/'.$property->id)); ?>" title="Edit" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="<?php echo e(url('/admin/delete-property/'.$property->id)); ?>" title="Delete" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                                <!-- Property Information Model -->
                                <div class="modal fade bs-example-modal-lg" id="property_<?php echo e($property->id); ?>" tabindex="-1" role="dialog" aria-labelledby="propertyView">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content row">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><?php echo e($property->property_name); ?> | Full Details</h4>
                                            </div>
                                            <div class="modal-body col-sm-12">
                                                <div class="col-sm-6">
                                                    <?php if(!empty($property->image_name)): ?>
                                                    <img width="320" class="img-responsive" src="<?php echo e(asset('/images/backend_images/property_images/large/'.$property->image_name)); ?>">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><strong>Property Code:</strong> <?php echo e($property->property_code); ?></p>
                                                    <p><strong>Description:</strong> <?php echo e(strip_tags(str_limit($property->description, $limit=80))); ?></p>
                                                    <h5><strong>Price:</strong> <span style="color: #e60f0f;"><?php echo e($property->property_price); ?>/-</span></h5>
                                                    <p><strong>Category:</strong> <?php echo e($property->service_name); ?></p>
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
                                    <th>Property Id</th>
                                    <th>Property Image</th>
                                    <th>Property Name</th>
                                    <th>Service Name</th>
                                    <th>Property Code</th>
                                    <th>Property Price</th>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/property/view-property.blade.php ENDPATH**/ ?>