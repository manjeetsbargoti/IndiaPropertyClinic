<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Edit Page</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form enctype="multipart/form-data" method="POST" action="<?php echo e(url('/admin/pages/'.$page->id.'/edit')); ?>"
                            id="add_page" name="add_page" novalidate="novalidate">
                            <?php echo e(csrf_field()); ?>

                            <div class="col-sm-8 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Page Title">Title</label>
                                            <input name="page_title" id="CMSPageTitle" type="text" class="form-control" value="<?php echo e($page->title); ?>">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label for="Url">Url</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">Url</span>
                                                <input type="text" name="slug" id="CMSslug" class="form-control" value="<?php echo e($page->url); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden">
                                        <div class="form-group">
                                            <label for="Page Title">Page id</label>
                                            <input name="page_id" id="PageID" type="text" class="form-control" value="<?php echo e($page->id); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <textarea name="description" id="description" class="form-control my-editor"><?php echo $page->content; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Meta Title">Meta Title</label>
                                    <input name="meta_title" id="MetaTitle" type="text" class="form-control" placeholder="<?php echo e($page->title); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Meta Description">Meta Description</label>
                                    <textarea name="meta_description" id="MetaDescription" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Meta Keywords">Meta Keywords</label>
                                    <textarea name="meta_keywords" id="MetaKeywords" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Canonical Url">Canonical Url</label>
                                    <input name="canonical_url" id="CanonicalUrl" type="text" class="form-control" placeholder="<?php echo e(url('/'.$page->url)); ?>">
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="Page Type">Page Type</label>
                                    <select name="page_type" id="CMSPageType" class="form-control">
                                        <option value="" selected> -- Select Page Type -- </option>
                                        <option value="1" <?php if($page->page_type == 1): ?> selected <?php endif; ?>>Standard Page</option>
                                        <option value="2" <?php if($page->page_type == 2): ?> selected <?php endif; ?>>Property Page</option>
                                    </select>
                                </div>
                                <div class="form-group <?php if($page->page_type == 1): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageTemplates">
                                    <label for="Template">Template Design</label>
                                    <select name="template" id="CMSTemplates" class="form-control">
                                        <option value="" selected> -- Select Template -- </option>
                                        <option value="1">Default (Full-width)</option>
                                        <option value="2">Full with Sidebar</option>
                                        <option value="3">Contact Page</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Page Status">Page Status</label>
                                    <select name="page_status" id="PageStatus" class="form-control">
                                        <option value="" selected> -- Select Status -- </option>
                                        <option value="1" <?php if($page->status == 1): ?> selected <?php endif; ?>>Publish</option>
                                        <option value="2" <?php if($page->status == 2): ?> selected <?php endif; ?>>Draft</option>
                                    </select>
                                </div>
                                <div class="form-group <?php if($page->page_type == 2): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageCountry">
                                    <label for="Property For Country">Country</label>
                                    <select name="country_prop" id="country_CMSedit" class="form-control">
                                        <?php echo $country_dropdown; ?>
                                    </select>
                                </div>
                                <div class="form-group <?php if($page->page_type == 2): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageState">
                                    <label for="Property For State">State</label>
                                    <select name="state_prop" id="state_CMSedit" class="form-control" data-placeholder="-- Select State --">
                                        <?php echo $state_dropdown; ?>
                                    </select>
                                </div>
                                <div class="form-group <?php if($page->page_type == 2): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageCity">
                                    <label for="Property For City">City</label>
                                    <select name="city_prop" id="city_CMSedit" class="form-control" data-placeholder="-- Select City --">
                                        <?php echo $city_dropdown; ?>
                                    </select>
                                </div>
                                <div class="form-group <?php if($page->page_type == 2): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageCSC">
                                    <label for="Property For">Property for Country, State or City</label>
                                    <select name="prop_for" id="PropFor" class="form-control" data-placeholder="-- Property For --">
                                        <option value="" selected>Select Property for</option>
                                        <option value="1" <?php if($page->property_for == 1): ?> selected <?php endif; ?>>Country</option>
                                        <option value="2" <?php if($page->property_for == 2): ?> selected <?php endif; ?>>State</option>
                                        <option value="3" <?php if($page->property_for == 3): ?> selected <?php endif; ?>>City</option>
                                    </select>
                                </div>

                                <div class="form-group <?php if($page->page_type == 2): ?> show <?php else: ?> hidden <?php endif; ?>" id="CMSPageBRS">
                                    <label for="Property For">Property for Buy, rent or Sale</label>
                                    <select name="service_id" id="ServiceID" class="form-control" data-placeholder="-- Property For Buy/Rent/Sale --">
                                        <option value="" selected>Property For Buy/Rent/Sale</option>
                                        <?php $__currentLoopData = \App\Services::where('parent_id', '!=', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($servic->id); ?>" <?php if($servic->id == $page->service_id): ?> selected <?php endif; ?>><?php echo e($servic->service_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Feature Image">Feature Image</label>
                                    <input type="hidden" name="current_image" id="FeatureCurrentImage" value="<?php echo e($page->image); ?>">
                                    <input type="file" class="form-control" name="feature_image" id="FeatureImage">
                                    <?php if(!empty($page->image)): ?>
                                        <img class="img-responsive" width="200" style="padding-top: 1em;" src="<?php echo e(asset('/images/backend_images/page_images/large/'.$page->image)); ?>"> <a <?php // href="{{ url('/admin/delete-property-image/'.$propertyDetails->id) }}" ?> >Delete</a>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/admin/pages/edit_page.blade.php ENDPATH**/ ?>