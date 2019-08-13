<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add Property Services</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Add Services</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="box box-info">
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
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('/admin/edit-repair-services/'.$servicesDetails->id)); ?>" id="add_service" name="add_service" novalidate="novalidate">
                      <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="form-group">
                                    <label for="Service Name">Service Name</label>
                                    <input name="rservice_name" id="rservice_name" value="<?php echo e($servicesDetails->service_name); ?>" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Service Level</label>
                                    <select name="parent_id" id="parent_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="0">Main Service</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Url</span>
                                <input name="rservice_url" id="rservice_url" value="<?php echo e($servicesDetails->url); ?>" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Description">Short Description</label>
                            <textarea name="s_description" id="s_description" class="form-control my-editor"><?php echo e($servicesDetails->s_description); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" id="description" class="form-control my-editor"><?php echo e($servicesDetails->description); ?></textarea>
                        </div>

                        <!-- <div class="form-group">
                          <label>
                              <input type="checkbox" class="minimal-red"> Repairing Service
                          </label>
                        </div> -->

                        <div class="form-group">
                          <label>
                              <input type="checkbox" value="1" name="status" id="status" class="minimal-red" <?php if($servicesDetails->status=='1'): ?> checked <?php endif; ?> value="1"> Enable
                          </label>
                        </div>
                        
                        <div class="form-group">
                            <label for="Service Image">Repair Service Image</label>
                            <input type="hidden" name="current_image" id="rservice_image" value="<?php echo e($servicesDetails->service_image); ?>">
                            <input type="file" name="rservice_image" id="rservice_image" class="form-control-file">
                            <?php if(!empty($servicesDetails->service_image)): ?>
                            <img class="img-responsive" style="padding-top: 1em; width:100px;" src="<?php echo e(asset('/images/backend_images/repair_service_images/large/'.$servicesDetails->service_image)); ?>"> <a <?php // href="{{ url('/admin/delete-property-image/'.$propertyDetails->id) }}" ?> >Delete</a>
                            <?php endif; ?>
                          <!-- <p class="help-block">Example block-level help text here.</p> -->
                        </div>

                        <div class="form-group">
                            <label for="Service Banner">Repair Service Banner</label>
                            <input type="hidden" name="current_banner" id="rservice_banner" value="<?php echo e($servicesDetails->service_banner); ?>">
                            <input type="file" name="rservice_banner" id="rservice_banner" class="form-control-file">
                            <?php if(!empty($servicesDetails->service_banner)): ?>
                            <img class="img-responsive" width="200" style="padding-top: 1em;" src="<?php echo e(asset('/images/backend_images/repair_service_images/large/'.$servicesDetails->service_banner)); ?>"> <a <?php // href="{{ url('/admin/delete-property-image/'.$propertyDetails->id) }}" ?> >Delete</a>
                            <?php endif; ?>
                          <!-- <p class="help-block">Example block-level help text here.</p> -->
                        </div>
                        
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success btn-md pull-right">Submit</button>
                        </div>
                      </form>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/repair_services/edit_repair_service.blade.php ENDPATH**/ ?>