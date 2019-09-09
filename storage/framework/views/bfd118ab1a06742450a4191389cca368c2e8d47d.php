<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="smart_container">
    <div class="property_viewsec">
        <div class="container">
            <?php if(Session::has('flash_message_success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong><?php echo session('flash_message_success'); ?></strong>
                </div>
            <?php endif; ?>
                <div class="header_breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(url('/properties')); ?>">Properties</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($property->property_name); ?></li>
                        </ol>
                    </nav>
                    <p><span><?php if(!empty($property->city_name)): ?> <?php echo e($property->city_name); ?>,<?php endif; ?> <a href="<?php echo e(url('/country/'.$property->country.'/properties')); ?>"><?php if(!empty($property->country_name)): ?> <?php echo e($property->country_name); ?> <?php endif; ?></a> </span> | All Residential for Sale in <a href="<?php echo e(url('/state/'.$property->state.'/properties')); ?>"><?php if(!empty($property->state_name)): ?> <?php echo e($property->state_name); ?> <?php endif; ?></a> </p>
                </div>
            <div class="row">
            
            <div class="col-12 col-xl-8">
                    <div class="outer">
                    
                            <div id="big" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>" alt="<?php echo e($property->property_name); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div id="thumbs" class="owl-carousel owl-theme">
                                <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>" alt="<?php echo e($property->property_name); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            </div>
            </div>
           
            <div class="col-12 col-xl-4">
                <div class="overview_property">
                    <h1><i class="fas fa-map-marker-alt"></i> <a href="<?php echo e(url('/city/'.$property->city.'/properties')); ?>"><?php if(!empty($property->city_name)): ?> <?php echo e($property->city_name); ?>,<?php endif; ?> <?php if(!empty($property->country_name)): ?> <?php echo e($property->country_name); ?> <?php endif; ?></a></h1>
                    <h5><?php if($property->parea): ?>Plot Area: <span><?php echo e($property->parea); ?> Square Ft <?php endif; ?></span></h5>
                    <h6><?php echo e($property->property_name); ?></h6>
                    <!--<h5>Age of Property: <span>Under Construction</span></h5>-->
                    <h5><?php if($property->pfacing): ?>Facing: <span><?php echo e($property->pfacing); ?> <?php endif; ?></span></h5>
                    
                    <p style="font-size: 14px; color: #171747; font-weight: 500;"><?php echo e(str_limit(strip_tags($property->description), $limit=350)); ?></p>
                    <!-- <h3><?php echo e($property->currency); ?> <?php echo e($property->property_price); ?></h3> -->
                    
                    <?php if(!empty($property->property_price)): ?>
                    <h3><span><?php echo e($property->currency); ?></span> <?php echo e($property->property_price); ?></h3>
                    <?php else: ?>
                        <p><a href="javascript:avoid();" data-toggle="modal" data-target="#agentContact" class="btn_fullinfo">Get Price</a></p>
                    <?php endif; ?>
                    
                    <div class="protxt_top">
                        <ul>
                            <li><i><img src="/images/frontend_images/images/room.svg"></i><p><span><?php echo e($property->rooms); ?></span>Rooms</p></li>
                            <li><i><img src="/images/frontend_images/images/bedroom.svg"></i><p><span><?php echo e($property->bedrooms); ?></span>Bedrooms</p></li>
                            <li><i><img src="/images/frontend_images/images/bathroom.svg"></i><p><span><?php echo e($property->bathrooms); ?></span>Bathroom</p></li>
                        </ul>
                    </div>
                    <div class="agent_sec">
                        <div class="agent_profile">
                            <!-- <i class="fa fa-user fa-2x"></i> -->
                            <img class="img-responsive" src="<?php echo e(url('/images/user.png')); ?>"> 
                        </div>
                        <div class="agent_txt">
                        <?php if(!empty($property->agent_name)): ?>
                        <h6><a href="<?php echo e(url('/profile/'.$property->agent.'/user')); ?>"><?php echo e($property->agent_name); ?></a><?php if($property->status == 1): ?> <sup><img class="img-responsive" width="16" src="<?php echo e(url('/images/verified_badge.png')); ?>" alt="user verified badge"></sup><?php endif; ?></h6>
                        <?php elseif(!empty($property->builder_name)): ?>
                        <h6><a href="<?php echo e(url('/profile/'.$property->builder.'/user')); ?>"><?php echo e($property->builder_name); ?></a><?php if($property->status == 1): ?> <sup><img class="img-responsive" width="16" src="<?php echo e(url('/images/verified_badge.png')); ?>" alt="user verified badge"></sup><?php endif; ?></h6>
                        <?php elseif(!empty($property->addby_name)): ?>
                        <h6><a href="<?php echo e(url('/profile/'.$property->add_by.'/user')); ?>"><?php echo e($property->addby_name); ?></a><?php if($property->status == 1): ?> <sup><img class="img-responsive" width="16" src="<?php echo e(url('/images/verified_badge.png')); ?>" alt="user verified badge"></sup><?php endif; ?></h6>
                        <?php endif; ?>
                        <a class="agent_contact" href="javascript:avoid();" data-toggle="modal" data-target="#agentContact"><?php if(!empty($property->agent_name)): ?>AGENT Contact <?php elseif(!empty($property->builder_name)): ?>Builder Name <?php elseif(!empty($property->addby_name)): ?>Request a Call <?php endif; ?></a>
                        <a class="agent_contact contactbtn" href="javascript:avoid();" data-toggle="modal" data-target="#agentContact"><i class="fas fa-phone-volume"></i> View Mobile Number</a>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top: 1em;">
            <div class="sharethis-inline-share-buttons"></div>
        </div>
    </div>
    </div>

    <div class="spaceification_sec">
        <div class="container">
            <div class="row">
                <div class="col-12 xl-12 spaceification_secinn">
                    <div class="spaccei_tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php if($property->amenities): ?><li class="nav-item">
                                    <a class="nav-link <?php if(!empty($property->amenities)): ?> active <?php endif; ?>" id="amenities-tab" data-toggle="tab" href="#amenities" role="tab" aria-controls="amenities" aria-selected="true">Amenities</a>
                                </li><?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if(empty($property->amenities)): ?> active <?php endif; ?>" id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">Specifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Location</a>
                                </li>
                            </ul>
                            <div class="tab-content custom_tabcon" id="myTabContent">
                                <?php if(!empty($property->amenities)): ?><div class="tab-pane fade <?php if(!empty($property->amenities)): ?> show active <?php endif; ?>" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                                    <div class="amenities_item">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6 col-xl-12">
                                                <ul style="column-count:4;">
                                                    <?php $__currentLoopData = explode(',', $property->amenities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = \App\Amenity::where('amenity_code', $amenity)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $am): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li style="color: #171747; font-weight:500;font-family: Roboto; font-size: 14px;"><?php echo e($am->name); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>    
                                        </div>
                                </div><?php endif; ?>
                                <div class="tab-pane fade <?php if(empty($property->amenities)): ?> show active <?php endif; ?>" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                                    <div class="spaceification_box">
                                        <?php echo $property->description; ?>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="col-sm-6">
                                        <ul style="list-style: none;">
                                            <li><strong>Address:</strong> <?php echo e($property->address1); ?> <?php echo e($property->address2); ?></li>
                                            <li><strong>Locality:</strong> <?php echo e($property->locality); ?></li>
                                            <li><strong>City:</strong> <?php echo e($property->city_name); ?></li>
                                            <li><strong>State:</strong> <?php echo e($property->state_name); ?></li>
                                            <li><strong>Country:</strong> <?php echo e($property->country_name); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Properties -->

<div class="latest_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <!-- <div class="col-12 col-md-12 col-xl-12"> -->
                        <div class="col-12 col-sm-8 col-md-8 col-xl-8">
                            <div class="globleheadding text-left">
                                <h1>Related Property</h1>
                                <p>Find the latest homes for sale, property news & real estate market data </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-xl-4">
                            <div class="view_sec text-right">
                                <a class="btnview_all" href="<?php echo e(url('/properties')); ?>">View All</a>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <?php $counter = 0;?>
                    <?php $__currentLoopData = $property_on_location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relproperty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $counter++;?>
                    <?php if($counter <= 8): ?> <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                        <div class="product_box">
                            <div class="product_img">
                                <div class="owl-carousel product-slide owl-theme">
                                    <?php $__currentLoopData = \App\PropertyImages::where('property_id', $relproperty->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item"><img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="bottom_strip">
                                    <h6><i class="fas fa-map-marker-alt"></i>
                                        <?php if(!empty($relproperty->city)): ?>
                                        <span><?php $__currentLoopData = \App\Cities::where('id', $relproperty->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($c->name); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty($relproperty->country)): ?>
                                        <span><?php $__currentLoopData = \App\Country::where('iso2', $relproperty->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($ct->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        <?php endif; ?>
                                    </h6>
                                    <p><?php if($relproperty->parea): ?><?php echo e($relproperty->parea); ?> Square Ft <?php endif; ?></p>
                                    <?php $__currentLoopData = \App\Services::where('id', $relproperty->service_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="tagbtn rent">
                                        <?php echo e($pt->service_name); ?>

                                    </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="product_text">
                                <div class="protxt_top">
                                    <ul>
                                        <li><i><img src="/images/frontend_images/images/room.svg"></i>
                                            <p><span><?php echo e($relproperty->rooms); ?></span>Rooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bedroom.svg"></i>
                                            <p><span><?php echo e($relproperty->bedrooms); ?></span>Bedrooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bathroom.svg"></i>
                                            <p><span><?php echo e($relproperty->bathrooms); ?></span>Bathroom</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="protxt_inn">
                                    <h6><?php echo e($relproperty->property_name); ?></h6>
                                    <p><?php echo e(str_limit(strip_tags($relproperty->description), $limit=100)); ?></p>
                                    <div class="price_sec">
                                        <ul>
                                            <li>
                                                <?php if(!empty($relproperty->property_price)): ?>
                                                <h5><span><?php if(!empty($relproperty->country)): ?>
                                                        <?php $__currentLoopData = \App\Country::where('iso2', $relproperty->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($ct->currency); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?></span> <?php echo e($relproperty->property_price); ?></h5>
                                                <?php else: ?>
                                                <a href="/properties/<?php echo e($relproperty->property_url); ?>"
                                                    class="btn_fullinfo">Get Price</a>
                                                <?php endif; ?>
                                            </li>
                                            <li><a href="<?php echo e(url('/properties/'.$relproperty->property_url)); ?>"
                                                    class="btn_fullinfo">Full Info</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- /. Related Properties -->

<!-- Agent/Builders in this Area -->

<div class="latest_product <?php if(\App\User::whereIn('usertype', array('A','B'))->where('country', $property->country)->where('state', $property->state)->count() == 0): ?> d-none <?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="globleheadding text-left">
                            <h1>Builders/Agents in Same Area</h1>
                        </div>
                        <div class="dealers_sec">
                            <div class="owl-carousel dealerscarousel owl-theme">
                                <?php $__currentLoopData = \App\User::whereIn('usertype', array('A','B'))->where('country', $property->country)->where('state', $property->state)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <a href="<?php echo e(url('/profile/'.$d->id.'/user')); ?>">
                                        <div class="dealers_box">
                                            <div class="dealers_img"><img
                                                    src="<?php echo e(url('/images/user.png')); ?>"></div>
                                            <div class="dealers_txt">
                                                <h4><?php echo e($d->first_name); ?></h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /. Agent/Builders in this Area -->

<!-- Modal Property Agent Contact -->
<div class="modal fade bd-example-modal-sm" id="agentContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agentModalCenterTitle">
                  User Name
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo e(url('/properties/'.$property->property_url)); ?>" name="agent_contact" id="agent_contact">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label for="I am.."><strong>I am..</strong></label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="Individual" selected>Individual</option>
                            <option value="Dealer">Dealer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input required type="text" name="name" id="name" class="form-control"  placeholder="Name*">
                    </div>
                    <div class="form-group">
                        <input required type="email" name="email" id="email" class="form-control" placeholder="Email*">
                    </div>
                    <div class="form-group">
                        <input required type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number*">
                    </div>
                    <div class="form-group">
                        <input required type="hidden" name="queryforname" id="queryforname" class="form-control" value="<?php echo e($property->property_name); ?>">
                    </div>
                    <div class="form-group">
                        <input required type="hidden" name="queryfor" id="queryfor" class="form-control" value="<?php echo e(url('/properties/'.$property->property_url)); ?>">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="1" name="accept_condition" id="accept_condition" required>
                        <label class="form-check-label" for="defaultCheck1">
                                I agree to be contacted by India Property Clinic and others for similar properties or related services
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn submit_btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Model Property Agent Contact end -->

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/frontend/view_single_property.blade.php ENDPATH**/ ?>