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
                <div class="box box-purple">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="allusers-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Property Image</th>
                                    <th>Property Name</th>
                                    <th>Service Name</th>
                                    <th>Location</th>
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
                                    <?php if(!empty($property->image_name)): ?>
                                    <td><img width="60px" class="thumb"
                                            src="<?php echo e(asset('/images/backend_images/property_images/large/'.$property->image_name)); ?>">
                                    </td>
                                    <?php else: ?>
                                    <td><img width="60px" class="thumb"
                                            src="<?php echo e(asset('/images/backend_images/property_images/large/default.jpg')); ?>">
                                    </td>
                                    <?php endif; ?>
                                    <td><a target="_blank"
                                            href="<?php echo e(url('/properties/'.$property->property_url)); ?>"><?php echo e($property->property_name); ?></a>
                                    </td>
                                    <td><span class="label label-md label-success"><?php echo e($property->service_name); ?></span>
                                    </td>
                                    <td><?php if(!empty($property->city)): ?><?php $__currentLoopData = \App\Cities::where('id',
                                        $property->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($city->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                        <?php if(!empty($property->country)): ?><?php $__currentLoopData = \App\Country::where('iso2',
                                        $property->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($country->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                    </td>
                                    <td><?php if($property->property_price): ?><?php echo e($property->currency); ?>

                                        <?php echo e($property->property_price); ?><?php endif; ?></td>
                                    <td>
                                        <a data-target="#property_<?php echo e($property->id); ?>" data-toggle="modal"
                                            title="Detail" class="btn btn-success btn-xs"><i class="fa fa-info-circle"
                                                aria-hidden="true"></i></a>
                                        <?php if(Auth::user()->admin == 1): ?>
                                        <a href="<?php echo e(url('/admin/property/'.$property->id.'/edit')); ?>" title="Edit"
                                            class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i></a>
                                        <a href="<?php echo e(url('/admin/property/'.$property->id.'/delete')); ?>" title="Delete"
                                            class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                aria-hidden="true"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info_1" id="allusers-table_info_1" role="status" aria-live="polite">
                                Showing 1 to 10 of 10 entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers_1" id="allusers-table_paginate_1">
                                <?php echo $properties->render(); ?>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Property Information Model -->
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-lg" id="property_<?php echo e($property->id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo e($property->property_name); ?> by
                        <?php echo e($property->user_fname); ?> <?php echo e($property->user_lname); ?></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-4">
                        <?php if(!empty($property->image_name)): ?>
                        <img width="320" class="img-responsive"
                            src="<?php echo e(asset('/images/backend_images/property_images/large/'.$property->image_name)); ?>">
                        <?php else: ?>
                        <img width="320" class="img-responsive"
                            src="<?php echo e(asset('/images/backend_images/property_images/large/default.jpg')); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Reference Code</td>
                                    <td><?php echo e($property->property_code); ?></td>
                                </tr>
                                <tr>
                                    <td>Property Name</td>
                                    <td><?php echo e($property->property_name); ?></td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td><strong><?php if($property->property_price): ?><?php echo e($property->currency); ?>

                                            <?php echo e($property->property_price); ?><?php endif; ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Property For</td>
                                    <td><label
                                            class="label label-md label-success"><?php echo e($property->service_name); ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Add By</td>
                                    <td><a href="javascript:void()" data-target="#userinfo_<?php echo e($property->user_id); ?>"
                                            data-toggle="modal"><?php echo e($property->user_fname); ?>

                                            <?php echo e($property->user_lname); ?></a></td>
                                </tr>
                                <tr>
                                    <td>Posted on</td>
                                    <td><?php echo e(date('d M, Y h:i:s A', strtotime($property->created_at))); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Property Url</td>
                                    <td><a href="<?php echo e(url('/propreties/'.$property->property_url)); ?>"
                                            target="_blank"><?php echo e(url('/propreties/'.$property->property_url)); ?></a></td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><label class="label label-md label-info"><?php $__currentLoopData = \App\PropertyTypes::where('property_type_code', $property->property_type_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($pt->property_type); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></label></td>
                                </tr>
                                <tr>
                                    <td>Featured Property</td>
                                    <td><?php if($property->featured == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Commercial Property</td>
                                    <td><?php if($property->commercial == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Property Area (in sqft.)</td>
                                    <td><?php if(!empty($property->parea)): ?><?php echo e($property->parea); ?> sqft. <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Property Facing</td>
                                    <td><?php echo e($property->pfacing); ?></td>
                                </tr>
                                <tr>
                                    <td>Transection Type</td>
                                    <td><?php echo e($property->transection_type); ?></td>
                                </tr>
                                <tr>
                                    <td>Construction Status</td>
                                    <td><?php echo e($property->construction_status); ?></td>
                                </tr>
                                <tr>
                                    <td>Builder</td>
                                    <td><a href="javascript:void()" data-target="#builderinfo_<?php echo e($property->builder_id); ?>"
                                            data-toggle="modal"><?php echo e($property->builder_fname); ?> <?php echo e($property->builder_lname); ?></a></td>
                                </tr>
                                <tr>
                                    <td>Agent</td>
                                    <td><a href="javascript:void()" data-target="#agentinfo_<?php echo e($property->agent_id); ?>"
                                            data-toggle="modal"><?php echo e($property->agent_fname); ?> <?php echo e($property->agent_lname); ?></a></td>
                                </tr>
                                <tr>
                                    <td>Road Facing</td>
                                    <td><?php if($property->road_facing == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Corner Shop</td>
                                    <td><?php if($property->c_shop == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-condensed table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td>Map Passed</td>
                                    <td><?php if($property->map_pass == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Open Sides</td>
                                    <td><?php echo e($property->open_sides); ?></td>
                                </tr>
                                <tr>
                                    <td>Bedrooms</td>
                                    <td><?php echo e($property->bedrooms); ?></td>
                                </tr>
                                <tr>
                                    <td>Bathrooms</td>
                                    <td><?php echo e($property->bathrooms); ?></td>
                                </tr>
                                <tr>
                                    <td>Balconies</td>
                                    <td><?php echo e($property->balconies); ?></td>
                                </tr>
                                <tr>
                                    <td>Furnish Type</td>
                                    <td><?php echo e($property->furnish_type); ?></td>
                                </tr>
                                <tr>
                                    <td>Floor no.</td>
                                    <td><?php echo e($property->floorno); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Floors</td>
                                    <td><?php echo e($property->total_floors); ?></td>
                                </tr>
                                <?php if($property->property_type_id == 1019): ?>
                                <tr>
                                    <td>Apple Trees</td>
                                    <td><?php echo e($property->apple_trees); ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($property->commercial == 1): ?>
                                <tr>
                                    <td>Personal Washroom</td>
                                    <td><?php if($property->p_washrooms == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Cafeteria</td>
                                    <td><?php if($property->cafeteria == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td>Personal Showroom</td>
                                    <td><?php if($property->p_showroom == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td>Wall Made</td>
                                    <td><?php if($property->wall_made == 1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- /. Property information Model -->

    <!-- User Modal -->
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = \App\User::where('id',$property->user_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-md" id="userinfo_<?php echo e($property->user_id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo e($property->user_fname); ?> <?php echo e($property->user_lname); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>"
                                alt="<?php echo e($userinfo->first_name); ?>">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo e($userinfo->first_name); ?> <?php echo e($userinfo->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo e($userinfo->email); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo e($userinfo->phone); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td><?php if($userinfo->admin == 1): ?> Admin <?php else: ?> <?php echo e($userinfo->usertype); ?> <?php endif; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td><?php echo e($userinfo->business_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td><?php echo e($userinfo->about_business); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo e($userinfo->country); ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo e($userinfo->state); ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo e($userinfo->city); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td><?php echo e(date('d M, Y h:i:s A', strtotime($userinfo->created_at))); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- /. User Modal -->
    <!-- Agent Modal -->
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = \App\User::where('id',$property->agent_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-md" id="agentinfo_<?php echo e($property->agent_id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo e($property->agent_fname); ?> <?php echo e($property->agent_lname); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>"
                                alt="<?php echo e($userinfo->first_name); ?>">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo e($userinfo->first_name); ?> <?php echo e($userinfo->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo e($userinfo->email); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo e($userinfo->phone); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td><?php if($userinfo->admin == 1): ?> Admin <?php else: ?> <?php echo e($userinfo->usertype); ?> <?php endif; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td><?php echo e($userinfo->business_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td><?php echo e($userinfo->about_business); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo e($userinfo->country); ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo e($userinfo->state); ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo e($userinfo->city); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td><?php echo e(date('d M, Y h:i:s A', strtotime($userinfo->created_at))); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- /. Agent Modal -->

    <!-- Builder Modal -->
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = \App\User::where('id',$property->builder_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bd-example-modal-md" id="builderinfo_<?php echo e($property->builder_id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="userView">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo e($property->builder_fname); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <img class="img-responsive img-circle" src="<?php echo e(url('/dist/img/user2-160x160.jpg')); ?>"
                                alt="<?php echo e($userinfo->first_name); ?>">
                        </div>
                        <div class="col-sm-8">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo e($userinfo->first_name); ?> <?php echo e($userinfo->last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo e($userinfo->email); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo e($userinfo->phone); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Usertype</td>
                                        <td><?php if($userinfo->admin == 1): ?> Admin <?php else: ?> <?php echo e($userinfo->usertype); ?> <?php endif; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped table-hover">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Business Name</td>
                                        <td><?php echo e($userinfo->business_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td>About Business</td>
                                        <td><?php echo e($userinfo->about_business); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo e($userinfo->country); ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?php echo e($userinfo->state); ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?php echo e($userinfo->city); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td><?php echo e(date('d M, Y h:i:s A', strtotime($userinfo->created_at))); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- /. Builder Modal -->

</div>
<!-- /.content-wrapper -->

<style>
.dataTables_info,
.paging_simple_numbers {
    display: none;
}

.pagination {
    margin: 10px 20px 20px 0px;
    float: right;
}

.dataTables_info_1 {
    margin: 20px;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/property/view-property.blade.php ENDPATH**/ ?>