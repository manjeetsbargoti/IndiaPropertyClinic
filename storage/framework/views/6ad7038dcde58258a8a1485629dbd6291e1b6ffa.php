<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New Category</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add New Category</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('/admin/blog/category/new')); ?>"
                            id="add_blog_category" name="add_blog_category" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Category Name">Category Name</label>
                                        <input name="category_name" id="category_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <label for="Category Url">Category Url</label>
                                    <input name="url" id="url" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="Parent Category">Parent Category</label>
                                        <select name="parent_category" id="parent_category" class="form-control">
                                            <option value="0" selected>Main Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Description">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
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
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/blog/category/add_category.blade.php ENDPATH**/ ?>