<?php $__env->startSection('content'); ?>

    <div class = "wrapper" >

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Welcome, <span><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Users</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../dist/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center text-blue"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h3>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <p class="text-muted text-center text-orange"><strong><?php echo e($u->user_type); ?></strong></p>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php if(Auth::user()->admin == 0): ?>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <?php if(Auth::user()->usertype == 'A' || Auth::user()->usertype == 'U' || Auth::user()->usertype == 'B'): ?>
                  <b>Property Listed</b> <a class="pull-right"><?php echo e(\App\Property::where('add_by', Auth::user()->id)->count()); ?></a>
                  <?php elseif(Auth::user()->usertype == 'V'): ?>
                  <b>Assign Case</b> <a class="pull-right"><?php echo e(\App\RequestService::where('assign_to', Auth::user()->id)->count()); ?></a>
                  <?php endif; ?>
                </li>

                <?php if(Auth::user()->usertype == 'V'): ?>
                <li class="list-group-item">
                  <b>Solved</b> <a class="pull-right"><?php echo e(\App\RequestService::where('assign_to', Auth::user()->id)->where('status', 1)->count()); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Pending</b> <a class="pull-right"><?php echo e(\App\RequestService::where('assign_to', Auth::user()->id)->where('status', 0)->count()); ?></a>
                </li>
                <?php endif; ?>
              </ul>
              <?php endif; ?>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-3">

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Contact info:</strong>

              <p class="text-muted">
                Email: <a class="text-blue" href="mailto:<?php echo e(Auth::user()->email); ?>"><?php echo e(Auth::user()->email); ?></a>
              </p>
              <p class="text-muted">
                Phone: <a class="text-blue" href="tel:<?php echo e(Auth::user()->phone); ?>"><?php echo e(Auth::user()->phone); ?></a>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-orange">
                        <?php if($city_count > 0): ?>
                            <span><?php echo e($u->city_name); ?>,</span> 
                        <?php else: ?>
                            <span title="Update Your City">City,</span>
                        <?php endif; ?>
                        <?php if($state_count > 0): ?>
                            <span><?php echo e($u->state_name); ?></span> 
                        <?php else: ?>
                            <span title="Update Your State">State</span>
                        <?php endif; ?>
                    </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Services</strong>

              <p><?php if(Auth::user()->usertype == 'V'): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = explode(',', $u->servicetypeid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = \App\OtherServices::where('id', $usti)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rsevices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="label label-sm label-success"><?php echo e($rsevices->service_name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php elseif(Auth::user()->usertype == 'A'): ?>
                <span class="label label-sm label-success">Agent</span>
                <?php elseif(Auth::user()->usertype == 'U'): ?>
                <span class="label label-sm label-success">Owner/Buyer</span>
                <?php elseif(Auth::user()->usertype == 'B'): ?>
                <span class="label label-sm label-success">Builder</span>
                <?php endif; ?>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
              <li><a href="#change_password" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="reviews">
                <!-- Post -->
                <div class="post">
                  <?php if(Auth::user()->review): ?>
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo e(url('/dist/img/user1-128x128.jpg')); ?>" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    
                  </p>
                  <?php else: ?>
                  <p style="text-align:center;">No Review yet!</p>
                  <?php endif; ?>
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <!-- <div class="tab-pane" id="timeline">
                <ul class="timeline timeline-inverse">
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div> -->
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" name="user_profile_update" id="UserProfileUpdate" method="post" action="<?php echo e(url('/user/account')); ?>">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="first_name" id="UserFirstName" value="<?php echo e(Auth::user()->first_name); ?>" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="last_name" id="UserLastName" value="<?php echo e(Auth::user()->last_name); ?>" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" id="UserEmail" value="<?php echo e(Auth::user()->email); ?>" placeholder="Email Address">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPhone" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="phone" id="UserPhone" value="<?php echo e(Auth::user()->phone); ?>" placeholder="Phone Number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputBusiness" class="col-sm-3 control-label">Business Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="business" id="UserBusiness" placeholder="Business Name" value="<?php echo e(Auth::user()->business_name); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="About Business" class="col-sm-3 control-label">About Business</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="about_business" id="AboutBusiness" placeholder="ABout your business.."><?php echo e(Auth::user()->about_business); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="WorkExperience" class="col-sm-3 control-label">Experience</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="work_experience" id="WorkExperience" placeholder="Work Experience" value="<?php echo e(Auth::user()->experience); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="User Type" class="col-sm-3 control-label">User Type</label>
                    <div class="col-sm-9">
                      <select type="text" class="form-control" name="user_type" id="UserType" placeholder="Skills">
                          <?php $__currentLoopData = \App\UserType::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($userlist->usercode); ?>" <?php if($userlist->usercode == Auth::user()->usertype): ?> selected <?php endif; ?>><?php echo e($userlist->usertype_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group <?php if(Auth::user()->usertype == 'V'): ?> show <?php else: ?> hidden <?php endif; ?>">
                    <label for="Service Type" class="col-sm-3 control-label">Services</label>
                    <div class="col-sm-9">
                      <select name="service_type[]" multiple="multiple" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" data-placeholder="Select Services" id="ServiceType">
                        <?php $__currentLoopData = \App\OtherServices::where('parent_id', '0')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($rservice->id); ?>" <?php $__currentLoopData = explode(',', Auth::user()->servicetypeid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($rservice->id == $usid): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>><?php echo e($rservice->service_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-info">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="change_password">
                <form class="form-horizontal" method="post" action="<?php echo e(url('/admin/update-pwd')); ?>">
                <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    <label for="Current Password" class="col-sm-2 control-label">Current Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="current_pwd" id="current_pwd">
                      <span id="chkPwd"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="New Password" class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="new_pwd" id="new_pwd">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Confirm Password" class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="conf_password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->
        


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/auth/users/user_account.blade.php ENDPATH**/ ?>