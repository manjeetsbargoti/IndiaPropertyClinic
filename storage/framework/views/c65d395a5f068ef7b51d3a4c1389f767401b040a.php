<?php $__env->startSection('content'); ?>

<div class="smart_container">
    <div class="services_viewsec">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="services_viewbanner" style="background-image:url('<?php echo e(url('images/backend_images/repair_service_images/large/'.$service->service_banner)); ?>')">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            <div class="overlay_services"></div>
            <div class="services_viewbannertxt">
                <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 col-xl-5">
                        <div class="header_breadcrumb white">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($service->service_name); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                            </nav>
                        </div>
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h1><?php echo e($service->service_name); ?></h1>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <ul class="serliststyle">
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo str_limit($service->s_description, $limit=400); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <a href="#" role="button" class="btn btn-danger">Get Qute</a>
                        <a href="#" role="button" class="btn btn-warning">Call Now</a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-xl-4 ml-auto">
                        <div class="ser_prcessing">
                            <h4>What Services matter needs to be addressed?</h4>
                            <div class="ser_prcessinginn">
                                <?php $counter = 0; ?>
                                <?php $__currentLoopData = $sub_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $counter ++; ?>
                                <?php if($counter <= 4): ?>
                                <a href="<?php echo e(url('/services/'.$sub_service->url)); ?>"><?php echo e($sub_service->service_name); ?><i class="fas fa-angle-double-right"></i></a>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class="serview_container">
    <div class="container">
        <div id="ser_howitwork" class="serview_conbox">
            <div class="verticalser_listsec">
                
                <div class="row">
                <p><?php // echo print_r($sub_services); ?></p>
                    <div class="col-12 col-sm-4 col-xl-3">
                        <div class="accordion" id="cat">
                            <?php $counter = 0; ?>
                            <?php $__currentLoopData = $sub_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $counter ++; ?>
                            <div class="accordion_outersec">
                                <!-- <div class="accordion_header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($sub_service->id); ?>" aria-expanded="true" aria-controls="collapseOne">
                                            
                                        </button>
                                    </h5>
                                </div> -->
                                <div class="accordion_header" id="headingOne">
                                    <h5 class="mb-0">
                                    <a href="<?php echo e($sub_service->url); ?>"><?php echo e($sub_service->service_name); ?></a>
                                    <button class="arrowbtn" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($sub_service->id); ?>" aria-expanded="true" aria-controls="collapseOne">

                                        <?php if(!empty($otherServices)): ?>
                                        <i class="fas fa-chevron-down"></i>
                                        <?php endif; ?>
                                    </button>
                                    </h5>
                                </div>
                                <div id="collapse_<?php echo e($sub_service->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#cat">
                                    <div class="accordionbody">
                                        <ul class="sublist">
                                            <?php $__currentLoopData = $otherServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rservices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($rservices->parent_id == $sub_service->id): ?>
                                                <li><a href="<?php echo e($rservices->url); ?>"><?php echo e($rservices->service_name); ?></a></li>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-8 col-xl-9">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo $service->s_description; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <?php echo $service->description; ?>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
            </div>
        </div>
        <!-- </div> -->
        <div class="related_product">
            <h5>Related Product</h5>
            <div class="row">
                <?php $__currentLoopData = $randervice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                    <div class="related_productbox">
                        <a href="<?php echo e(url('/services/'.$service->url)); ?>">
                            <div class="related_productboximg">
                                <img src="<?php echo e(url('images/frontend_images/images/dry-pipe.jpg')); ?>">
                            </div>
                            <h5> <?php echo e($service->service_name); ?> </h5>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div id="ser_professionals" class="serview_conbox">
            <div class="row">
                <?php $__currentLoopData = \App\User::where('usertype', 'V')->inRandomOrder()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                    <a href="<?php echo e(url('/profile/'.$v->id.'/user')); ?>"><div class="fireman">
                        <div class="boxuser_pic">
                            <img src="<?php echo e(url('images/frontend_images/images/user2.jpg')); ?>">
                        </div>
                        <div class="boxuser_details">
                            <h5 style="overflow: hidden;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;"><?php echo e($v->first_name); ?> <?php echo e($v->last_name); ?></h5>
                            <p><?php echo e($v->country); ?>, <?php echo e($v->state); ?>, <?php echo e($v->city); ?></p>
                        </div>
                    </div></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/repair_services/single_repair_service.blade.php ENDPATH**/ ?>