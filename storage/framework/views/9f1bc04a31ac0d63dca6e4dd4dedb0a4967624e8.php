<?php $__env->startSection('content'); ?>

<div class="smart_container">
    <div class="banner_secouter">
        <div class="banner_sec">
            <div class="banner_inn">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 m-auto">
                            <h4 class="bannerhead">India's Largest Real Estate Marketplace</h4>
                            <?php if(Session::has('searcherr')): ?>
                            <div class="alert alert-success">
                                <?php echo Session::get('searcherr'); ?>

                            </div>
                            <?php endif; ?>
                            <div class="search_sec">
                                <div class="search_secinn">
                                    <ul class="nav nav-pills" id="searchTab" role="tablist">
                                        <?php $counter = 0;?>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($service->parent_id != 0): ?>
                                        <?php $counter++;?>
                                        <li class="nav-item">
                                            <a class="nav-link <?=($counter == 1) ? 'active' : ''?>"
                                                id="search<?php echo e($service->service_name); ?>-tab" data-toggle="tab"
                                                href="#search<?php echo e($service->service_name); ?>" role="tab"
                                                aria-controls="search<?php echo e($service->service_name); ?>"
                                                aria-selected="<?=($counter == 1) ? 'true' : ''?>"><?php echo e($service->service_name); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="tab-content tab_conarea" id="myTabContent">
                                    <h5>Property search for rent and sales <a href="javascript:void(0)"
                                            data-toggle="modal" data-target="#exampleModalCenter">Advanced Search</a>
                                    </h5>
                                    <?php $counter = 0;?>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($service->parent_id != 0): ?>
                                    <?php $counter++;?>
                                    <div class="tab-pane fade show <?=($counter == 1) ? 'active' : ''?>"
                                        id="search<?php echo e($service->service_name); ?>" role="tabpanel"
                                        aria-labelledby="search<?php echo e($service->service_name); ?>-tab">
                                        <form action="<?php echo e(url('/search-result')); ?>" method="post">
                                            <div class="row search_field">
                                                <div class="col-12 col-sm-12 col-md-7 p-0">
                                                    <div class="jiosearch_outer">
                                                        <input type="hidden" value="<?php echo e($service->id); ?>"
                                                            name="property_cat">
                                                        <input type="text" name="search_text" id="search_name"
                                                            class="search_location"
                                                            placeholder="Type Location or Project/Society or Keyword">
                                                    </div>

                                                </div>
                                                <div class="col-12 col-sm-12 col-md-3 padding_none">
                                                    <select name="property_type">
                                                        <option value="">Property Type</option>
                                                        <?php $__currentLoopData = $propertyType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->property_type); ?>

                                                        </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-2 p-0">
                                                    <button type="submit">Search</button>
                                                </div>
                                            </div>
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div id="searchlist"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 mt-3 text-center">
                            <img src="/images/frontend_images/images/18.gif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="othersertop_sec">
            <div class="container">
                <div class="owl-carousel services owl-theme">
                    <?php $__currentLoopData = $otherServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($othservice->parent_id==0): ?>
                    <div class="item">
                        <a target="_blank" href="<?php echo e(url('/services/'.$othservice->url)); ?>">
                            <div class="service_box oter_serbox">
                                <div class="serbox_img"><img
                                        src="<?php echo e(asset('/images/backend_images/repair_service_images/large/'.$othservice->service_image)); ?>">
                                </div>
                                <div class="serbox_txt">
                                    <h4><?php echo e($othservice->service_name); ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    </div>


    <div class="featured_property">
        <div class="container">
            <div class="globleheadding text-left">
                <h1>Featured Property</h1>
                <p>Find the latest homes for sale, property news & real estate market data </p>
            </div>

            <div class="row">
                <?php $__currentLoopData = $featureProperty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->index < 2): ?> <div class="col-12 col-sm-6 col-md-12 col-lg-6 col-xl-6">
                    <div class="product_box featurepro_box">
                        <div class="product_img">
                            <div class="owl-carousel feauture-slide owl-theme">
                                <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item"><img height="180"
                                        src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="rateing">
                                <i class="staricon">Featured</i>
                            </div>
                            <div class="bottom_strip">
                                <h6><i class="fas fa-map-marker-alt"></i>
                                    <?php if(!empty($property->city_name)): ?>
                                    <span><?php echo e($property->city_name); ?>,</span>
                                    <?php endif; ?>
                                    <?php if(!empty($property->country_name)): ?>
                                    <span><?php echo e($property->country_name); ?></span>
                                    <?php endif; ?>
                                </h6>
                                <p><?php echo e($property->parea); ?> Square Ft</p>
                                <span class="tagbtn rent"><?php echo e($property->service_name); ?></span>
                            </div>
                        </div>
                        <div class="product_text">
                            <div class="protxt_top">
                                <ul>
                                    <li><i><img src="/images/frontend_images/images/room.svg"></i>
                                        <p><span><?php echo e($property->rooms); ?></span>Rooms</p>
                                    </li>
                                    <li><i><img src="/images/frontend_images/images/bedroom.svg"></i>
                                        <p><span><?php echo e($property->bedrooms); ?></span>Bedrooms</p>
                                    </li>
                                    <li><i><img src="/images/frontend_images/images/bathroom.svg"></i>
                                        <p><span><?php echo e($property->bathrooms); ?></span>Bathroom</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="protxt_inn">
                                <h6><?php echo e($property->property_name); ?></h6>
                                <p><?php echo e(strip_tags(str_limit($property->description, $limit=120))); ?></p>
                                <div class="price_sec">
                                    <ul>
                                        <li>
                                            <?php if(!empty($property->property_price)): ?>
                                            <h5><span><?php if(!empty($property->currency)): ?> <?php echo e($property->currency); ?>

                                                    <?php endif; ?></span> <?php echo e($property->property_price); ?></h5>
                                            <?php else: ?>
                                            <a href="/properties/<?php echo e($property->property_url); ?>" class="btn_fullinfo">Get
                                                Price</a>
                                            <?php endif; ?>
                                        </li>
                                        <li><a href="<?php echo e(url('/properties/'.$property->property_url)); ?>"
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



<div class="latest_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                        <div class="globleheadding text-left">
                            <h1>Latest Property</h1>
                            <p>Find the latest homes for sale, property news & real estate market data </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 col-xl-8">
                        <div class="latest_producttab mb-3">
                            <ul class="nav nav-pills" id="productTab" role="tablist">
                                <?php $counter = 0;?>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->parent_id != 0): ?>
                                <?php $counter++;?>
                                <li class="nav-item">
                                    <a class="nav-link show <?=($counter == 1) ? 'active' : ''?>"
                                        id="<?php echo e($service->service_name); ?>-tab" data-toggle="tab"
                                        href="#<?php echo e($service->service_name); ?>" role="tab"
                                        aria-controls="<?php echo e($service->service_name); ?>"
                                        aria-selected="<?=($counter == 1) ? 'true' : ''?>"><?php echo e($service->service_name); ?></a>
                                </li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-xl-4">
                        <div class="view_sec text-right">
                            <a class="btnview_all" href="<?php echo e(url('/properties')); ?>">View All</a>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <?php $counter = 0;?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($service->parent_id != 0): ?>
                    <?php $counter++;?>
                    <div class="tab-pane fade show <?=($counter == 1) ? 'active' : ''?>"
                        id="<?php echo e($service->service_name); ?>" role="tabpanel"
                        aria-labelledby="<?php echo e($service->service_name); ?>-tab">
                        <div class="row">
                            <?php $counter = 0;?>
                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($property->service_id == $service->id ): ?>
                            <?php $counter++;?>
                            <?php if( $counter <= 4): ?> <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="product_box">
                                    <div class="product_img">
                                        <div class="owl-carousel product-slide owl-theme">
                                            <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="item">
                                                <img
                                                    src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>">
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="bottom_strip">
                                            <h6><i class="fas fa-map-marker-alt"></i>
                                                <?php if(!empty($property->city_name)): ?>
                                                <span><?php echo e($property->city_name); ?>,</span>
                                                <?php endif; ?>
                                                <?php if(!empty($property->country_name)): ?>
                                                <span><?php echo e($property->country_name); ?></span>
                                                <?php endif; ?>
                                            </h6>
                                            <p><?php echo e($property->parea); ?> Square Ft</p>
                                            <span class="tagbtn rent"><?php echo e($property->service_name); ?></span>
                                        </div>
                                    </div>
                                    <div class="product_text">
                                        <div class="protxt_top">
                                            <ul>
                                                <li><i><img src="/images/frontend_images/images/room.svg"></i>
                                                    <p><span><?php echo e($property->rooms); ?></span>Rooms</p>
                                                </li>
                                                <li><i><img src="/images/frontend_images/images/bedroom.svg"></i>
                                                    <p><span><?php echo e($property->bedrooms); ?></span>Bedrooms</p>
                                                </li>
                                                <li><i><img src="/images/frontend_images/images/bathroom.svg"></i>
                                                    <p><span><?php echo e($property->bathrooms); ?></span>Bathroom</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="protxt_inn">
                                            <h6><?php echo e($property->property_name); ?></h6>
                                            <p><?php echo e(str_limit(strip_tags($property->description), $limit=80)); ?></p>
                                            <div class="price_sec">
                                                <ul>
                                                    <li>
                                                        <?php if(!empty($property->property_price)): ?>
                                                        <h5><span><?php if(!empty($property->currency)): ?>
                                                                <?php echo e($property->currency); ?> <?php endif; ?></span>
                                                            <?php echo e($property->property_price); ?></h5>
                                                        <?php else: ?>
                                                        <a href="/properties/<?php echo e($property->property_url); ?>"
                                                            class="btn_fullinfo">Get Price</a>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li><a href="<?php echo e(url('/properties/'.$property->property_url)); ?>"
                                                            class="btn_fullinfo">Full Info</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- <div class="view_sec text-center"><a class="btnview_all" href="<?php echo e(url('/properties')); ?>">View
                            All</a></div> -->
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-12 col-md-3 col-xl-3" style="display:none;">
            <div class="globleheadding text-left">
                <h1>Free Ads</h1>
                <p>Find the latest homes for sale</p>
            </div>
            <div class="free_ads">
                <div class="owl-carousel feature-slide owl-theme">
                    <div class="item">
                        <img src="/images/frontend_images/images/ads.jpg">
                    </div>
                    <div class="item">
                        <img src="/images/frontend_images/images/ads.jpg">
                    </div>
                    <div class="item">
                        <img src="/images/frontend_images/images/ads.jpg">
                    </div>
                    <div class="item">
                        <img src="/images/frontend_images/images/ads.jpg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Commercial Properties -->
<div class="latest_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 col-xl-8">
                        <div class="globleheadding text-left">
                            <h1>Commercial Property</h1>
                            <p>Find the latest homes for sale, property news & real estate market data </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-xl-4">
                        <div class="view_sec text-right">
                            <a class="btnview_all" href="<?php echo e(url('/properties')); ?>">View All</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $counter = 0;?>
                    <?php $__currentLoopData = \App\Property::where('commercial', 1)->orderBy('created_at', 'desc')->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $counter++;?>
                    <?php if($counter <= 3): ?> <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="product_box">
                            <div class="product_img">
                                <div class="owl-carousel product-slide owl-theme">
                                    <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item"><img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>">
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="bottom_strip">
                                    <h6><i class="fas fa-map-marker-alt"></i>
                                        <?php if(!empty($property->city)): ?>
                                        <span><?php $__currentLoopData = \App\Cities::where('id', $property->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($c->name); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty($property->country)): ?>
                                        <span><?php $__currentLoopData = \App\Country::where('iso2', $property->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($ct->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
                                        <?php endif; ?>
                                    </h6>
                                    <p><?php echo e($property->parea); ?> Square Ft</p>
                                    <?php $__currentLoopData = \App\Services::where('id', $property->service_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                            <p><span><?php echo e($property->rooms); ?></span>Rooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bedroom.svg"></i>
                                            <p><span><?php echo e($property->bedrooms); ?></span>Bedrooms</p>
                                        </li>
                                        <li><i><img src="/images/frontend_images/images/bathroom.svg"></i>
                                            <p><span><?php echo e($property->bathrooms); ?></span>Bathroom</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="protxt_inn">
                                    <h6><?php echo e($property->property_name); ?></h6>
                                    <p><?php echo e(str_limit(strip_tags($property->description), $limit=100)); ?></p>
                                    <div class="price_sec">
                                        <ul>
                                            <li>
                                                <?php if(!empty($property->property_price)): ?>
                                                <h5><span><?php if(!empty($property->country)): ?>
                                                        <?php $__currentLoopData = \App\Country::where('iso2', $property->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($ct->currency); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?></span> <?php echo e($property->property_price); ?></h5>
                                                <?php else: ?>
                                                <a href="/properties/<?php echo e($property->property_url); ?>"
                                                    class="btn_fullinfo">Get Price</a>
                                                <?php endif; ?>
                                            </li>
                                            <li><a href="<?php echo e(url('/properties/'.$property->property_url)); ?>"
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
<!-- /.Commercial Properties -->

<!-- Other Services -->
<div class="oter_services">
    <div class="container">
        <div class="globleheadding white">
            <h1>Repair Services</h1>
            <p>Find the latest homes for sale, property news & real estate market data </p>
        </div>
        <div class="other_sercarousel">
            <div class="owl-carousel services owl-theme">
                <?php $__currentLoopData = $otherServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($othservice->parent_id==0): ?>
                <div class="item">
                    <div class="service_box">
                        <div class="serbox_img"><img
                                src="<?php echo e(asset('/images/backend_images/repair_service_images/large/'.$othservice->service_image)); ?>">
                        </div>
                        <div class="serbox_txt">
                            <h4><?php echo e($othservice->service_name); ?></h4>
                            <a href="<?php echo e(url('/services/'.$othservice->url)); ?>">View All</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<!-- /. Other Services -->

<!-- Properties in Contenent -->
<div class="top_countries">
    <div class="container">
        <div class="globleheadding">
            <h1>Properties By Continents</h1>
            <p>You can use the theme places short-code to list specific cities or areas<br>
                where you have properties ready to sale/rent.</p>
        </div>
        <div class="top_countries_sec">
            <ul class="continents">
                <?php $__currentLoopData = $continents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $continent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li data-toggle="tooltip" data-placement="top" title="<?php echo e($continent->name); ?>">
                    <a href="#_<?php echo e($continent->code); ?>" data-toggle="modal">
                        <img src="/images/frontend_images/images/<?php echo e($continent->icon_image); ?>">
                        <p><?php echo e($continent->name); ?></p>
                    </a>
                </li>


                <div class="modal fade bd-example-modal-lg" id="_<?php echo e($continent->code); ?>" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id=""><?php echo e($continent->name); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="country_list">
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($country->continent == $continent->code): ?>
                                    <li>
                                        <a href="<?php echo e(url('/country/'.$country->iso2.'/properties')); ?>"
                                            style="margin: 0.2em 0em;"
                                            class="btn btn-outline-dark"><?php echo e($country->name); ?></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
</div>
<!-- /. Properties in Contenent -->

<div class="global_estate">
    <div class="container">
        <div class="global_estatein">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 mt-4">
                    <div class="viewsource">
                        <img src="/images/frontend_images/images/icon-01.png">
                    </div>
                    <div class="viewsourcetxt">
                        <h1>3,17,077+</h1>
                        <p>Properties & Counting...</p>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-4 mt-4">
                    <div class="viewsource">
                        <img src="/images/frontend_images/images/icon-02.png">
                    </div>
                    <div class="viewsourcetxt">
                        <h1>3,000+</h1>
                        <p>Properties Listed</p>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-4 mt-4">
                    <div class="viewsource">
                        <img src="/images/frontend_images/images/icon-03.png">
                    </div>
                    <div class="viewsourcetxt">
                        <h1>5,175+</h1>
                        <p>Sellers Contacted</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dealers -->
<div class="latest_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12">
                        <div class="globleheadding text-left">
                            <h1>Builders/Agents</h1>
                        </div>
                        <div class="dealers_sec">
                            <div class="owl-carousel dealerscarousel owl-theme">
                                <?php $__currentLoopData = $dealer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <a href="<?php echo e(url('/profile/'.$d->id.'/user')); ?>">
                                        <div class="dealers_box">
                                            <div class="dealers_img"><img
                                                    src="/images/frontend_images/images/default.jpg"></div>
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
<!-- /.Dealers -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/home.blade.php ENDPATH**/ ?>