<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Recent Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Properties</span>
              <span class="info-box-number"><?php echo $property_count; ?></small></span>
            </div>
          </div>
        </div>
        <?php if(Auth::user()->admin == 1 || Auth::user()->usertype == 'S'): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Home Loan Query</span>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Total &nbsp;&nbsp;<?php echo $homeloan_total_count; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Pending &nbsp;&nbsp;<?php echo $homeloan_pen_count; ?></label></a>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div class="clearfix visible-sm-block"></div>

        <?php if(Auth::user()->admin == 1 || Auth::user()->usertype == 'S'): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-help"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Property Query</span>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Total &nbsp;&nbsp;<?php echo $propertyq_total_count; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Pending &nbsp;&nbsp;<?php echo $propertyq_pen_count; ?></label></a>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if(Auth::user()->admin == 1 || Auth::user()->usertype == 'S'): ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <a href="<?php echo e(url('/admin/users')); ?>" class="user-count"><label class="btn btn-info btn-xs">Total &nbsp;&nbsp;<?php echo $contUser; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-success btn-xs">Active &nbsp;&nbsp;<?php echo $contActUser; ?></label></a>
              <a href="#" class="user-count"><label class="btn btn-danger btn-xs">Inactive &nbsp;&nbsp;<?php echo $contInactUser; ?></label></a>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <?php if(Auth::user()->usertype == 'A' || Auth::user()->usertype == 'B' || Auth::user()->usertype == 'U' || Auth::user()->usertype == 'S' || Auth::user()->admin == 1): ?>
      <div class="row">
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Property</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php $counter = 0 ; ?>
                <?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $counter++ ; ?>
                <?php if( $counter <= 4): ?>
                <li class="item">
                  <div class="product-img"><span class="label label-info"><?php echo e(date('d M, Y', strtotime($p->created_at))); ?> </span>
                    <?php if(!empty($p->image_name)): ?>
                        <img style="width: 67px !important;" class="img-responsive" src="<?php echo e(asset('/images/backend_images/property_images/large/'.$p->image_name)); ?>" alt="<?php echo e($p->property_name); ?>">
                    <?php else: ?>
                        <img style="width: 67px !important;" class="img-responsive" src="<?php echo e(asset('/images/backend_images/property_images/large/default.jpg')); ?>" alt="<?php echo e($p->property_name); ?>">
                    <?php endif; ?>
                  </div>
                  <div class="product-info">
                    <a href="<?php echo e(url('/properties/')); ?>/<?php echo e($p->property_url); ?>" target="_blank" class="product-title"><?php echo e(str_limit($p->property_name, $limit=50)); ?>

                    <span class="label label-success pull-right"><?php if(!empty($p->currency)): ?><?php echo e($p->currency); ?> <?php endif; ?> <?php echo e($p->property_price); ?></span>
                    <span class="product-description"><?php echo e(strip_tags(str_limit($p->description, $limit=100))); ?></span>
                  </div>
                </li>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?php echo e(url('/admin/properties')); ?>" class="uppercase">View All Proerty</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <?php endif; ?>
        <?php if(Auth::user()->admin == 1): ?>
        <div class="col-md-5">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Members</h3>
              <div class="box-tools pull-right">
                <span class="label label-success">New Members</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                <?php $counter = 0 ; ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $counter++ ; ?>
                <?php if( $counter <= 8): ?>
                <li>
                  <img title="<?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>" src="../../dist/img/user1-128x128.jpg" alt="<?php echo e($u->first_name); ?> Image">
                  <a title="<?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>" class="users-list-name" href="#"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></a>
                  <!-- <span class="users-list-date"><?php echo e($u->created_at); ?></span> -->
                  <?php if($u->status == 1): ?>
                  <a href="/admin/disable/<?php echo e($u->id); ?>" class="label label-success">Active</a>
                  <?php else: ?>
                  <a href="/admin/enable/<?php echo e($u->id); ?>" class="label label-danger">Inactive</a>
                  <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="<?php echo e(url('/admin/users')); ?>" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <?php endif; ?>
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>