<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Ads Management</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Ads Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                  <div class="box box-success">
                    <!-- form start -->
                    <form  enctype="multipart/form-data" method="POST">
                    <?php echo e(csrf_field()); ?>

                      <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Medium Rectangle: (300×250)</label>
                                  <textarea name="mid_rec_300_250" id="mid_rec_300_250" cols="30" rows="7" class="form-control"><?php echo $mid_rec_300_250; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Square: (250×250)</label>
                                  <textarea name="square_250_250" id="square_250_250" cols="30" rows="7" class="form-control"><?php echo $square_250_250; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Leaderboard: (728×90)</label>
                                  <textarea name="leaderboard_728_90" id="leaderboard_728_90" cols="30" rows="7" class="form-control"><?php echo $leaderboard_728_90; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Half Page: (300×600)</label>
                                  <textarea name="half_page_300_600" id="half_page_300_600" cols="30" rows="7" class="form-control"><?php echo $half_page_300_600; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Large Mobile Banner: (320×100)</label>
                                  <textarea name="large_mobile_banner_320_100" id="large_mobile_banner_320_100" cols="30" rows="7" class="form-control"><?php echo $large_mobile_banner_320_100; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Wide Skyscraper: (160x600)</label>
                                  <textarea name="wide_skyscraper_160_600" id="wide_skyscraper_160_600" cols="30" rows="7" class="form-control"><?php echo $wide_skyscraper_160_600; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Large Leaderboard: (970x90)</label>
                                  <textarea name="large_leaderboard_970_90" id="large_leaderboard_970_90" cols="30" rows="7" class="form-control"><?php echo $large_leaderboard_970_90; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                  <label>Banner: (468x60)</label>
                                  <textarea name="banner_468_60" id="banner_468_60" cols="30" rows="7" class="form-control"><?php echo $banner_468_60; ?></textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
                      </div>
                    </form>
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/google_ads/google_ads_code.blade.php ENDPATH**/ ?>