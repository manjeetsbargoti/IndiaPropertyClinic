<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add Query</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Query</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('/admin/add-phone-query')); ?>"
                            id="add_page" name="add_page" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Person Name">Person Name</label>
                                            <input name="name" id="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Usertype">Usertype</label>
                                            <select name="usertype" id="usertype" class="form-control">
                                                <option value="" selected>Select Usertype</option>
                                                <option value="Owner">Owner</option>
                                                <option value="Agent">Agent</option>
                                                <option value="Builder">Builder</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Phone">Phone</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Phone</span>
                                                <input type="text" name="phone" id="phone" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Email Address">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Email</span>
                                                <input type="text" name="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Property For">Property For</label>
                                            <select name="property_for" id="property_for" class="form-control">
                                                <option value="" selected>Select Property For</option>
                                                <option value="Rent">Rent</option>
                                                <option value="Sale">Sale</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Property Type">Property Type</label>
                                            <select name="property_type" id="property_type" class="form-control">
                                                <option value="" selected>Select Property Type</option>
                                                <?php $__currentLoopData = \App\PropertyTypes::where('status', 1)->orderBy('property_type', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pt->property_type); ?>"><?php echo e($pt->property_type); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="description" id="description" class="form-control my-editor"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="Description">Address</label>
                                    <textarea name="address" id="address" class="form-control" ></textarea>
                                </div>
                                
                                
                                <div class="form-group" id="Country">
                                    <label for="Property For Country">Country</label>
                                    <select name="country_prop" id="country" class="form-control">
                                        <option value="" selected>Select Country</option>
                                        <?php $__currentLoopData = \App\Country::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cntry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($cntry->iso2); ?>"><?php echo e($cntry->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group" id="State">
                                    <label for="Property For State">State</label>
                                    <select name="state_prop" id="state" class="form-control" data-placeholder="-- Select State --">
                                        <option value="" selected>Select State</option>
                                    </select>
                                </div>
                                <div class="form-group" id="City">
                                    <label for="Property For City">City</label>
                                    <select name="city_prop" id="city" class="form-control" data-placeholder="-- Select City --">
                                        <option value="" selected>Select City</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ZipCode">ZipCode</label>
                                    <input type="text" class="form-control" name="zipcode" id="zipcode">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="SubmitQuery" class="btn btn-info btn-block btn-md">Submit Query</button>
                                </div>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/queries/add_phone_queries.blade.php ENDPATH**/ ?>