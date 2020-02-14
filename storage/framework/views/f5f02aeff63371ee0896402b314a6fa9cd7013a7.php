  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
              <div class="pull-left image">
                  <img src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                  <p><?php echo e(Auth::user()->first_name); ?></p>
                  <!-- Status -->
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                              class="fa fa-search"></i>
                      </button>
                  </span>
              </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
              <li class="header">HEADER</li>
              <!-- Optionally, you can add icons to the links -->
              <li class="<?php echo e((request()->is('admin/dashboard')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/dashboard')); ?>"><i class="fa fa-dashboard"></i>
                      <span>Dashboard</span></a></li>
            <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/system*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/system/options')); ?>"><i class="fa fa-cogs text-green"></i> <span>System</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/system/homepage-content')) ? 'active':''); ?>"><a
                              href="<?php echo e(url('/admin/system/homepage-content')); ?>"><i
                                  class="fa fa-file text-yellow"></i>Homepage Content</a></li>
                      <li class="<?php echo e((request()->is('admin/system/options')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/options')); ?>"><i class="fa fa-sliders text-yellow"></i>Site
                              Options</a></li>
                      <li class="<?php echo e((request()->is('admin/system/contact-info')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/contact-info')); ?>"><i class="fa fa-phone text-yellow"></i>Contact
                              Info</a></li>
                      <li class="<?php echo e((request()->is('admin/system/robots.txt')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/robots.txt')); ?>"><i class="fa fa-file text-yellow"></i>Robots.txt</a>
                      </li>
                      <li class="<?php echo e((request()->is('admin/system/htaccess')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/htaccess')); ?>"><i class="fa fa-file text-yellow"></i>.htaccess</a>
                      </li>
                      <li class="<?php echo e((request()->is('admin/system/custom-code')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/custom-code')); ?>"><i class="fa fa-code text-yellow"></i>Custom
                              Code</a></li>
                      <li class="<?php echo e((request()->is('admin/system/editor')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/system/editor')); ?>"><i class="fa fa-terminal text-yellow"></i>Editor</a></li>
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/contacts*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/contacts')); ?>"><i class="fa fa-phone text-yellow"></i> <span>Contacts</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/contacts')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/contacts')); ?>"><i class="fa fa-building text-green"></i> <span>Contact
                                  List</span></a></li>
                      <li class="<?php echo e((request()->is('admin/contacts/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/contacts/new')); ?>"><i class="fa fa-building text-green"></i> <span>Add
                                  Contact</span></a></li>
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->admin  == 1 || Auth::user()->usertype  == 'S'): ?>
              <li class="treeview <?php echo e((request()->is('admin/pages*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/pages')); ?>"><i class="fa fa-file-o text-yellow"></i> <span>Pages</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/pages')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/pages')); ?>"><i class="fa fa-file text-green"></i> <span>Pages</span></a></li>
                      <li class="<?php echo e((request()->is('admin/pages/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/pages/new')); ?>"><i class="fa fa-plus text-green"></i> <span>Add
                                  Page</span></a></li>
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->admin == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/ppc*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/ppc/pages')); ?>"><i class="fa fa-telegram text-green"></i> <span>PPC Management</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/ppc/pages')) ? 'active':''); ?>"><a
                              href="<?php echo e(url('/admin/ppc/pages')); ?>"><i class="fa fa-file text-yellow"></i>
                              <span>PPC Pages</span></a></li>
                      <li class="<?php echo e((request()->is('admin/ppc/page/new')) ? 'active':''); ?>"><a
                              href="<?php echo e(url('/admin/ppc/page/new')); ?>"><i class="fa fa-plus text-yellow"></i> <span>New
                                  Page</span></a></li>
                  </ul>
              </li>
              <?php endif; ?>
            <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/user*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/users')); ?>"><i class="fa fa-users text-red"></i> <span>Users</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/users')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/users')); ?>"><i class="fa fa-circle-o text-yellow"></i>All Users</a>
                      </li>
                      <li class="<?php echo e((request()->is('admin/user/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/user/new')); ?>"><i class="fa fa-user-plus text-yellow"></i>Add
                              User</a></li>
                      <!--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i>Add User Type</a></li>-->
                      <!--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i>View User Type</a></li>-->
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/service*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/services')); ?>"><i class="fa fa-gears"></i> <span>Property Services</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/services')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/services')); ?>"><i class="fa fa-circle-o text-red"></i>View
                              Services</a></li>
                      <li class="<?php echo e((request()->is('admin/service/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/service/new')); ?>"><i class="fa fa-circle-o text-red"></i>Add Services</a></li>
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->admin  == 1): ?>
              <!--<li class="treeview">-->
              <!--    <a href="#"><i class="fa fa-building  "></i> <span>Property Type</span>-->
              <!--        <span class="pull-right-container">-->
              <!--            <i class="fa fa-angle-left pull-right"></i>-->
              <!--        </span>-->
              <!--    </a>-->
              <!--    <ul class="treeview-menu">-->
              <!--        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i>View Property Type</a></li>-->
              <!--        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i>Add Property Type</a></li>-->
              <!--    </ul>-->
              <!--</li>-->
            <?php endif; ?>
            <?php if(Auth::user()->admin  == 1 || Auth::user()->usertype  == 'S'): ?>
              <li class="treeview <?php echo e((request()->is('admin/repair-service*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/repair-services')); ?>"><i class="fa fa-gear"></i> <span>Repair Services</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/repair-services')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/repair-services')); ?>"><i class="fa fa-circle-o text-green"></i>View
                              Services</a></li>
                      <li class="<?php echo e((request()->is('admin/repair-service/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/repair-service/new')); ?>"><i class="fa fa-circle-o text-green"></i>Add
                              Service</a></li>
                  </ul>
              </li>
            <?php endif; ?>
            <?php if(Auth::user()->usertype  == 'A' || Auth::user()->usertype  == 'B' || Auth::user()->usertype  == 'U' || Auth::user()->usertype  == 'S' || Auth::user()->admin == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/properties')) ? 'active':''); ?> <?php echo e((request()->is('admin/property*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/properties')); ?>"><i class="fa fa-building text-green"></i> <span>Property</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/properties')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/properties')); ?>"><i class="fa fa-circle-o text-purple"></i>View
                              Properties</a></li>
                      <li class="<?php echo e((request()->is('admin/property/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/property/new')); ?>"><i class="fa fa-circle-o text-purple"></i>Add
                              Property</a></li>
                      <?php if(Auth::user()->admin == 1): ?>
                      <li class="<?php echo e((request()->is('admin/property/amenities')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/property/amenities')); ?>"><i class="fa fa-s15 text-yellow"></i>Amenities</a>
                      </li>
                      <li class="<?php echo e((request()->is('admin/property/amenity/new')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/property/amenity/new')); ?>"><i class="fa fa-plus text-yellow"></i>Add
                              Amenities</a></li>
                      <?php endif; ?>
                  </ul>
              </li>
              <?php endif; ?>
              <?php if(Auth::user()->usertype  == 'A' || Auth::user()->usertype  == 'B' || Auth::user()->usertype  == 'U' || Auth::user()->usertype  == 'S' || Auth::user()->admin == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/categories*')) ? 'active':''); ?> <?php echo e((request()->is('admin/blog*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/blog')); ?>"><i class="fa fa-building text-green"></i> <span>Blog</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/blog*')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/blog')); ?>"><i class="fa fa-circle-o text-purple"></i>All Blog</a></li>
                      <li class="<?php echo e((request()->is('admin/categories*')) ? 'active':''); ?>"><a href="<?php echo e(route('admin.categories')); ?>"><i class="fa fa-circle-o text-purple"></i>All categories</a></li>
                  </ul>
              </li>
              <?php endif; ?>
              <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/queries*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/queries/property')); ?>"><i class="fa fa-ticket text-green"></i> <span>Support Center</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/queries/property')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/queries/property')); ?>"><i
                                  class="fa fa-building text-yellow"></i>Property Support</a></li>
                      <li class="<?php echo e((request()->is('admin/queries/home-loan')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/queries/home-loan')); ?>"><i
                                  class="fa fa-rupee text-yellow"></i>Home Loan Support</a></li>
                      <li class="<?php echo e((request()->is('admin/queries/requested-quote')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/queries/requested-quote')); ?>"><i class="fa fa-address-book-o text-yellow"></i>Vendor
                              Query</a></li>
                      <li class="<?php echo e((request()->is('admin/queries/service-requests')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/queries/service-requests')); ?>"><i
                                  class="fa fa-thumbs-up text-yellow"></i>Service Requests</a></li>
                      <li class="<?php echo e((request()->is('admin/queries/phone-queries')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/queries/phone-queries')); ?>"><i class="fa fa-phone text-yellow"></i>Phone
                              Queries</a></li>
                      <li class="<?php echo e((request()->is('admin/queries/ppc-queries')) ? 'active':''); ?>"><a
                              href="<?php echo e(url('/admin/queries/ppc-queries')); ?>"><i
                                  class="fa fa-telegram text-yellow"></i>PPC
                              Queries</a></li>
                  </ul>
              </li>
              <?php endif; ?>
              <!--<li><a href="#"><i class="fa fa-envelope"></i> <span>Mail</span></a></li>-->
              <?php if(Auth::user()->admin == 1 || Auth::user()->usertype == 'B' || Auth::user()->usertype == 'A' || Auth::user()->usertype == 'U'): ?>
              <li class="treeview <?php echo e((request()->is('admin/csc*')) ? 'active':''); ?>">
                  <a href="<?php echo e(url('/admin/csc/city/add')); ?>"><i class="fa fa-globe text-green"></i> <span>CSC Database</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/csc/city/add')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/csc/city/add')); ?>"><i class="fa fa-check-square text-yellow"></i> <span>Add
                                  City</span></a></li>
                      <li class="<?php echo e((request()->is('admin/csc/state/add')) ? 'active':''); ?>"><a href="<?php echo e(url('/admin/csc/state/add')); ?>"><i class="fa fa-check-square text-yellow"></i> <span>Add
                                  State</span></a></li>
                  </ul>
              </li>
              <?php endif; ?>
              <?php if(Auth::user()->admin  == 1): ?>
              <li class="treeview">
                  <a href="#"><i class="fa fa-rocket text-green"></i> <span>SEO Tools</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="<?php echo e(url('/admin/sitemap')); ?>"><i class="fa fa-map text-yellow"></i>
                              <span>Sitemap</span></a></li>
                  </ul>
              </li>
              <?php endif; ?>
                <?php if(Auth::user()->usertype == 'V'): ?>
              <li class="treeview">
                  <a href="#"><i class="fa fa-file text-green"></i> <span>Cases</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-caret-square-o-right text-yellow"></i> <span>Assigned Cases</span></a></li>
                      <li><a href="#"><i class="fa fa-check-square-o text-yellow"></i> <span>Solved Cases</span></a></li>
                      <li><a href="#"><i class="fa fa-commenting-o text-yellow"></i> <span>Feedbacks</span></a></li>
                  </ul>
              </li>
              <?php endif; ?>
              <?php if(Auth::user()->admin == 1): ?>
              <li class="treeview <?php echo e((request()->is('admin/ads/*') ? 'active':'')); ?>">
                  <a href="<?php echo e(url('/admin/ads/ads-script')); ?>"><i class="fa fa-bullhorn text-green"></i> <span>Ads Management</span>
                      <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="<?php echo e((request()->is('admin/ads/ads-script') ? 'active':'')); ?>"><a href="<?php echo e(url('/admin/ads/ads-script')); ?>"><i class="fa fa-code-o-file text-yellow"></i> <span>Insert Code</span></a></li>
                  </ul>
              </li>
              <?php endif; ?>
          </ul>
          <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
  </aside><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/layouts/adminLayout/admin_sidebar.blade.php ENDPATH**/ ?>