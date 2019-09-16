<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Service Requests</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Service Request</li>
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
                                    <th>SR No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Req. Service</th>
                                    <th>Assign to</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0 ?>
                                <?php $__currentLoopData = $service_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i++ ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><strong><span
                                                style="font-family: 'Roboto'; color: orangered;"><?php echo e($sr->name); ?></span></strong>
                                    </td>
                                    <td><?php echo e($sr->email); ?></td>
                                    <td><?php echo e($sr->phone); ?></td>
                                    <td><span class="label label-sm label-success"><?php if(!empty($sr->subs_service)): ?>
                                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id',
                                            $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->main_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id',
                                            $sr->main_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($r_service->service_name); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></span></td>
                                    <td><?php $__currentLoopData = \App\User::where('id', $sr->assign_to)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <a href="javascript:void()" data-toggle="modal"
                                            data-target="#vendor_<?php echo e($sr->assign_to); ?>"><?php echo e(str_limit($vd->first_name, $limit=25)); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                    <td><?php echo e(date('d M, Y', strtotime($sr->created_at))); ?></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#sr_<?php echo e($sr->id); ?>"
                                            class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="modal" data-target="#assign_<?php echo e($sr->id); ?>"
                                            class="btn <?php if(empty($sr->assign_to)): ?> btn-warning <?php else: ?> btn-success <?php endif; ?> btn-xs">Assign</a>
                                        <?php if($sr->status == 1): ?>
                                        <a href="<?php echo e(url('/admin/service/request/'.$sr->id.'/pending')); ?>"
                                            class="btn btn-success btn-xs">Done</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(url('/admin/service/request/'.$sr->id.'/done')); ?>"
                                            class="btn btn-danger btn-xs">Pending</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Property Information Model -->
    <?php $__currentLoopData = $service_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bs-example-modal-lg" id="sr_<?php echo e($sr->id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Service Request for <?php if(!empty($sr->subs_service)): ?>
                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?>
                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></strong></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><?php echo e($sr->name); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><a href="mailto:<?php echo e($sr->email); ?>"><?php echo e($sr->email); ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td><a
                                            href="tel:<?php $__currentLoopData = \App\Country::where('iso2', $sr->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($cd->phonecode); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php echo e($sr->phone); ?>"><?php $__currentLoopData = \App\Country::where('iso2',
                                            $sr->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($cd->phonecode); ?>- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($sr->phone); ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong>Requested Service</strong></td>
                                    <td><a target="_blank"
                                            href="<?php if(!empty($sr->subs_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(url('/services/'.$r_service->url)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?> <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(url('/services/'.$r_service->url)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>"><?php if(!empty($sr->subs_service)): ?>
                                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?>
                                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong>Project Status</strong></td>
                                    <td><?php echo e($sr->project_status); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Project Timeline</strong></td>
                                    <td><?php echo e($sr->project_timeline); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Address Type</strong></td>
                                    <td><?php echo e($sr->address_type); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Are you Owner or Authorized</strong></td>
                                    <td><?php echo e($sr->ownership); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Interested in financing?</strong></td>
                                    <td><?php echo e($sr->financing); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description</strong></td>
                                    <td><?php echo e($sr->description); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td><?php echo e($sr->address); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>City, State, Country</strong></td>
                                    <td><?php $__currentLoopData = \App\Cities::where('id', $sr->city_name)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($citydata->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = \App\State::where('id',
                                        $sr->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $std): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($std->name); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = \App\Country::where('iso2',
                                        $sr->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($cnt->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Assign to</strong></td>
                                    <td><?php $__currentLoopData = \App\User::where('id', $sr->assign_to)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(str_limit($vd->first_name, $limit=25)); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Service Request Date</strong></td>
                                    <td><?php echo e(date('d M, Y h:i:s A', strtotime($sr->created_at))); ?></td>
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

    <!-- Assign Service to Vendor -->

    <?php $__currentLoopData = $service_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bs-example-modal-lg" id="assign_<?php echo e($sr->id); ?>" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #171747;"><strong>Assign Vendor for
                            <?php if(!empty($sr->subs_service)): ?>
                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?>
                            <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?> in <?php $__currentLoopData = \App\Cities::where('id',
                            $sr->city_name)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($citydata->name); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>,
                            <?php echo e($sr->country); ?></strong></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <form method="post" action="<?php echo e(url('/admin/service/request/'.$sr->id.'/assign')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="Vendor List">Service Provider in <?php $__currentLoopData = \App\Cities::where('id',
                                    $sr->city_name)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $citydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($citydata->name); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> for
                                    <?php if(!empty($sr->subs_service)): ?>
                                    <?php $__currentLoopData = \App\OtherServices::where('id', $sr->subs_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($sr->sub_service)): ?>
                                    <?php $__currentLoopData = \App\OtherServices::where('id', $sr->sub_service)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($r_service->service_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></label>
                                <select name="vendor_id" class="form-control" id="VendorList">
                                    <option value="" selected> -- Select Vendor -- </option>
                                    <?php $__currentLoopData = \App\User::where('servicetypeid', $sr->main_service)->where('usertype',
                                    'V')->where('city', $sr->city_name)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($userdata->id); ?>"><?php echo e($userdata->first_name); ?>

                                        <?php echo e($userdata->last_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-md" value="Assign">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- /. Assign Service to Vendor -->

    <!-- Vendor Infromation -->

    <?php $__currentLoopData = $service_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = \App\User::where('id', $sr->assign_to)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade bs-example-modal-lg" id="vendor_<?php echo e($sr->assign_to); ?>" tabindex="-1" role="dialog"
        aria-labelledby="propertyView">
        <div class="modal-dialog" role="document">
            <div class="modal-content row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color: #171747;"><?php echo e($user_info->first_name); ?>

                        <?php echo e($user_info->last_name); ?> | <?php $__currentLoopData = \App\Cities::where('id', $user_info->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ucity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($ucity->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = \App\State::where('id', $user_info->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ustate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($ustate->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e($user_info->country); ?></h4>
                </div>
                <div class="modal-body col-sm-12">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td><?php echo e($user_info->first_name); ?> <?php echo e($user_info->last_name); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><a href="mailto:<?php echo e($user_info->email); ?>"><?php echo e($user_info->email); ?></a></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td><a
                                            href="tel:<?php echo e($user_info->phonecode); ?><?php echo e($user_info->phone); ?>"><?php echo e($user_info->phonecode); ?>-<?php echo e($user_info->phone); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Offered Service</strong></td>
                                    <td><?php $__currentLoopData = explode(',', $user_info->servicetypeid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ofsl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = \App\OtherServices::where('id', $ofsl)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rsername): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <a
                                            href="<?php echo e(url('/services/'.$rsername->url)); ?>"
                                            class="label label-sm label-success"><?php echo e($rsername->service_name); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Join on</strong></td>
                                    <td><?php echo e(date('d M, Y h:i:s A', strtotime($user_info->created_at))); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Location</strong></td>
                                    <td><?php $__currentLoopData = \App\Cities::where('id', $user_info->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ucity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($ucity->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = \App\State::where('id',
                                        $user_info->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ustate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($ustate->name); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($user_info->country); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- /. Vendor Information -->

</div>
<!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/queries/request_service.blade.php ENDPATH**/ ?>