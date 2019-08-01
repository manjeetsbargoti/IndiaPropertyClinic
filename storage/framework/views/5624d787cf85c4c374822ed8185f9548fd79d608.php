<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New Page</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('/admin/new-page')); ?>"
                            id="add_page" name="add_page" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Page Title">Title</label>
                                            <input name="page_title" id="PageTitle" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Url">Url</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" name="slug" id="slug" class="form-control">
                                            </div>
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
                                    <label for="Page Type">Page Type</label>
                                    <select name="page_type" id="PageType" class="form-control">
                                        <option value="" selected> -- Select Page Type -- </option>
                                        <option value="1">Standard Page</option>
                                        <option value="2">Property Page</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Template">Template Design</label>
                                    <select name="template" id="Templates" class="form-control">
                                        <option value="" selected> -- Select Template -- </option>
                                        <option value="1">Default (Full-width)</option>
                                        <option value="2">Full with Sidebar</option>
                                        <option value="3">Contact Page</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="page Status">Page Status</label>
                                    <select name="page_status" id="PageStatus" class="form-control">
                                        <option value="" selected> -- Select Status -- </option>
                                        <option value="1">Publish</option>
                                        <option value="2">Draft</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Feature Image">Feature Image</label>
                                    <input type="file" class="form-control" name="feature_image" id="FeatureImage">
                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="AddNewPage" class="btn btn-info btn-block btn-md">Publish</button>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/pages/new_page.blade.php ENDPATH**/ ?>