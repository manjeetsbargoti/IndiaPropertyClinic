<?php $__env->startSection('content'); ?>

<style>
/* body {
    background-image: url('../../bg-tan.webp');
    background-attachment: fixed; 
    background-repeat: no-repeat;
    background-position: center center; 
    background-size: cover;
} */

/* Multi-Step Form */
* {
    /* box-sizing: border-box; */
}

#ServiceQuery {
    background-color: rgba(255, 255, 255, 0.5);
    padding: 20px;
    max-height: 350px;
    width: 100%;
    font-family: Roboto !important;
    position: absolute;
}

#ServiceQuery h1 {
    text-align: center;
}

#ServiceQuery .form-group{
    margin-bottom: 0.5rem !important;
}

#ServiceQuery #allcitylist {
    position: absolute;
}

#ServiceQuery p {
    text-align: center;
    margin-bottom: 0rem;
}

#ServiceQuery h4 {
    padding: 0em 0em 0em 0em;
    text-align: center;
    color: #171747;
}

#Description textarea {
    /* min-height: 200px; */
}

#ServiceQuery input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
}

#ServiceQuery label {
    font-size: 16px;
    font-family: Roboto;
    color: #171747;
    font-weight: 600;
}

/* Mark input boxes that get errors during validation: */
#ServiceQuery input.invalid {
    background-color: #ffdddd;
    border-color: #ff0000;
}

/* Hide all steps by default: */
#ServiceQuery .tab {
    display: none;
}

#ServiceQuery button:hover {
    opacity: 0.8;
}

/* Step marker: Place in the form. */
#ServiceQuery .step_rf {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
}

#ServiceQuery .step_rf.active {
    opacity: 1;
}

/* Mark the steps that are finished and valid: */
#ServiceQuery .step_rf.finish {
    background-color: #4CAF50;
    display: none;
}

#ServiceQuery .step.finish::before {
    display: none !important;
}

#ServiceQuery .citylistdropdown {
    list-style: none;
    /* position: relative; */
}

#ServiceQuery .citylistdropdown li {
    position: relative;
    border-top: 1px solid #ddd;
    padding: 7px 35px 7px 10px;
    color: #000;
}

#allcitylist {
    background: #fff;
    z-index: 99;
    width: 54.473%;
    padding: 0;
    max-height: 215px;
    overflow-y: auto;
    box-shadow: 0 5px 6px rgba(0, 0, 0, 0.5);
    /* left: 26px; */
}

#ServiceQuery span.flag_name {
    position: absolute;
    right: 5px;
    color: #a9a9a9;
    text-transform: uppercase;
    font-size: 11px;
}

#ServiceQuery ul.citylistdropdown li:hover {
    background: #f2f2f2;
    color: #F15A27;
}
</style>

<div class="smart_container">
    <div class="services_viewsec">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="services_viewbanner background-image"
            style="background-image:url('<?php echo e(url('images/backend_images/repair_service_images/large/'.$service->service_banner)); ?>')">
            <span role="img" aria-label="<?php echo e($service->service_name); ?>"> </span>
            <div class="overlay_services"></div>
            <div class="services_viewbannertxt">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-xl-5">
                            <div class="header_breadcrumb white">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>

                                        <li class="breadcrumb-item active" aria-current="page">
                                            <?php echo e($service->service_name); ?></li>

                                    </ol>
                                </nav>
                            </div>

                            <h1><?php echo e($service->service_name); ?></h1>

                            <ul class="serliststyle">

                                <li><?php echo str_limit(strip_tags($service->s_description), $limit=400); ?></li>

                            </ul>
                            <a href="<?php echo e(url('/service/request')); ?>"
                                style="border: 1px solid #f15a27; background: #f15a27; padding: 0.5em 1em; color: #fff; font-size: 15px; font-weight: 400; border-radius: 5px;"
                                role="button" class="get_quote_button">Get Quote</a>
                            <a href="tel:<?php echo e(config('app.phone')); ?>" role="button" class="btn btn-warning">Call Now</a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-xl-7">
                            <div class="ser_prcessing">
                                <!-- MultiStep Form -->
                                <form id="ServiceQuery" name="service_request_form" method="post"
                                    action="<?php echo e(url('/service/request')); ?>">
                                    <?php if(Session::has('flash_message_success')): ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                        <strong><?php echo session('flash_message_success'); ?></strong>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(Session::has('flash_message_error')): ?>
                                    <div class="alert alert-error alert-dismissible">
                                        <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                                        <strong><?php echo session('flash_message_error'); ?></strong>
                                    </div>
                                    <?php endif; ?>
                                    <?php echo e(csrf_field()); ?>

                                    <div class="tab">
                                        <h4>What is the location of your project?</h4>
                                        <div id="CityName" class="form-group citysearch_outer">
                                            <p><img src="<?php echo e(url('marker.webp')); ?>"></p>
                                            <label>City Name</label>
                                            <input type="text" name="city_name" id="city_name_id"
                                                class="form-control emptyformvalidations search_citylocation"
                                                placeholder="Enter City">
                                            <div id="allcitylist"></div>
                                        </div>
                                        <input type="hidden" name="page_uri" id="PageURI" value="<?php echo e($service->url); ?>">
                                    </div>
                                    <div class="tab">
                                        <h4>What kind of work do you need done?</h4>
                                        <div id="MainServiceOn" class="form-group">
                                            <select name="main_service" id="MainServiceOnList"
                                                class="form-control emptyformvalidations">
                                                <option value="" selected> -- Select Service -- </option>
                                                <?php $__currentLoopData = \App\OtherServices::where('parent_id', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_rservices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($main_rservices->id); ?>">
                                                    <?php echo e($main_rservices->service_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div id="SubServiceOn" class="form-group">
                                            <select name="sub_service" id="SubServiceOnList" class="form-control">
                                                <!-- <option value="test">Test</option> -->
                                            </select>
                                        </div>
                                        <div id="SubsServiceOn" class="form-group">
                                            <select name="subs_service" id="SubsServiceOnList" class="form-control">
                                                <!-- <option value="test">Test</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Choose the appropriate status for this project:</h4>
                                        <div id="ProjectStatus" class="form-group">
                                            <select class="form-control" name="project_status">
                                                <option value="Ready to hire">Ready to hire</option>
                                                <option value="Planning & Budgeting">Planning & Budgeting</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>When would you like this request to be done:</h4>
                                        <div id="ProjectTimeline" class="form-group">
                                            <select class="form-control" name="project_timeline">
                                                <option value="Timing is flexible">Timing is flexible</option>
                                                <option value="Within 1 week">Within 1 week</option>
                                                <option value="1-2 Weeks">1-2 Weeks</option>
                                                <option value="More than 2 weeks">More than 2 weeks</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>What kind of location is this?</h4>
                                        <div id="LocationType" class="form-group">
                                            <select class="form-control" name="address_type">
                                                <option value="Home/Residence">Home/Residence</option>
                                                <option value="Business">Business</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Are you owner or authorized to make changes?</h4>
                                        <div id="OwnerShip" class="form-group">
                                            <select class="form-control" name="ownership">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Are you interested in financing?</h4>
                                        <div id="FinanceStatus" class="form-group">
                                            <select class="form-control" name="financing">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Tell us about you Requirements.</h4>
                                        <div id="Description" class="form-group">
                                            <textarea class="form-control emptyformvalidations" name="description"
                                                id="description" cols="40"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Tell us about your location:</h4>
                                        <div id="LocationAddress" class="form-group">
                                            <label>Address:</label>
                                            <textarea class="form-control" name="address" id="address"
                                                cols="5"></textarea>
                                        </div>

                                        <div class="row">
                                            <div id="CountryOnList"
                                                class="form-group col-12 col-sm-4 col-md-4 col-xl-4">
                                                <label>Country</label>
                                                <select name="country" id="country_listOn"
                                                    class="form-control emptyformvalidations">
                                                    <?php $__currentLoopData = \App\Country::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->iso2); ?>"><?php echo e($country->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div id="StatesOnList" class="form-group col-12 col-sm-4 col-md-4 col-xl-4">
                                                <label>State</label>
                                                <select name="state" id="StateOnList"
                                                    class="form-control emptyformvalidations">
                                                    <!-- <option>State</option> -->
                                                </select>
                                            </div>
                                            <div class="form-group col-12 col-sm-4 col-md-4 col-xl-4">
                                                <label>Zipcode/Postal Code</label>
                                                <input type="text" name="zipcode" id="zipcode" class="form-control"
                                                    placeholder="Zipcode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        <h4>Tell us about your location:</h4>
                                        <div id="FullName" class="form-group">
                                            <!-- <label>Your Full Name</label> -->
                                            <input type="text" name="name" id="name"
                                                class="form-control emptyformvalidations"
                                                placeholder="Enter your name*">
                                        </div>
                                        <div id="EmailAddress" class="form-group">
                                            <!-- <label>Your Email Address</label> -->
                                            <input type="email" name="email" id="email"
                                                class="form-control emptyformvalidations" placeholder="Email Address*">
                                        </div>
                                        <div id="PhoneNumber" class="form-group">
                                            <!-- <label>Your Phone</label> -->
                                            <input type="text" name="phone" id="phone"
                                                class="form-control emptyformvalidations" placeholder="Phone Number*">
                                        </div>
                                    </div>
                                    <div style="overflow:auto;">
                                        <div style="float:right;" class="form-group">
                                            <button type="button" class="btn btn-warning navBtn" id="prevBtnRF"
                                                onclick="nextPrevRF(-1)">Previous</button>
                                            <button type="button" class="btn btn-info navBtn" id="nextBtnRF"
                                                onclick="nextPrevRF(1)">Next</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.MultiStep Form -->
                                <div style="text-align:center;margin-top:40px;">
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
                                    <span class="step_rf"></span>
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
                                <?php // $counter = 0; ?>
                                <?php if(\App\OtherServices::where('parent_id', $service->id)->count() > 0): ?>
                                <?php $__currentLoopData = \App\OtherServices::where('parent_id', $service->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="accordion_outersec">
                                    <div class="accordion_header" id="headingOne">
                                        <h5 class="mb-0">
                                            <a href="<?php echo e($sub_service->url); ?>"><?php echo e($sub_service->service_name); ?></a>
                                            <?php if(\App\OtherServices::where('parent_id', $sub_service->id)->count() != 0): ?>
                                            <button class="arrowbtn test" type="button" data-toggle="collapse"
                                                data-target="#collapse_<?php echo e($sub_service->id); ?>" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <?php if(!empty($otherServices)): ?>
                                                <i class="fas fa-chevron-down"></i>
                                                <?php endif; ?>
                                            </button>
                                            <?php endif; ?>
                                        </h5>
                                    </div>
                                    <div id="collapse_<?php echo e($sub_service->id); ?>" class="collapse"
                                        aria-labelledby="headingOne" data-parent="#cat">
                                        <div class="accordionbody">
                                            <ul class="sublist">
                                                <?php $__currentLoopData = $otherServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rservices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($rservices->parent_id == $sub_service->id): ?>
                                                <li><a href="<?php echo e($rservices->url); ?>"><?php echo e($rservices->service_name); ?></a>
                                                </li>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif(\App\OtherServices::where('parent_id', $service->id)->count() == 0): ?>
                                <?php $__currentLoopData = \App\OtherServices::where('parent_id', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php // $counter ++; ?>
                                <div class="accordion_outersec">
                                    <div class="accordion_header" id="headingOne">
                                        <h5 class="mb-0">
                                            <a href="<?php echo e($sub_service->url); ?>"><?php echo e($sub_service->service_name); ?></a>
                                            <?php if(\App\OtherServices::where('parent_id', $sub_service->id)->count() != 0): ?>
                                            <button class="arrowbtn" type="button" data-toggle="collapse"
                                                data-target="#collapse_<?php echo e($sub_service->id); ?>" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <?php if(!empty($otherServices)): ?>
                                                <i class="fas fa-chevron-down"></i>
                                                <?php endif; ?>
                                            </button>
                                            <?php endif; ?>
                                        </h5>
                                    </div>
                                    <div id="collapse_<?php echo e($sub_service->id); ?>" class="collapse"
                                        aria-labelledby="headingOne" data-parent="#cat">
                                        <div class="accordionbody">
                                            <ul class="sublist">
                                                <?php $__currentLoopData = $otherServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rservices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($rservices->parent_id == $sub_service->id): ?>
                                                <li><a href="<?php echo e($rservices->url); ?>"><?php echo e($rservices->service_name); ?></a>
                                                </li>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

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

                    </div>

                </div>
            </div>
            <!-- </div> -->

            <!-- Get Quote Model -->
            <div class="modal fade" id="GetServiceQuote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="GetQuote_user">Request A Quote</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Request Quote Form -->
                            <form method="post" action="<?php echo e(url('/services/'.$service->url)); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="form-group d-none">
                                    <input type="text" name="req_service_name" class="form-control"
                                        value="<?php echo e($service->service_name); ?>">
                                </div>
                                <div class="form-group">
                                    <textarea type="textarea" name="message" id="QuoteMessage" cols="8"
                                        class="form-control" placeholder="Query..."></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div> -->
                    </div>
                </div>
            </div>
            <!-- /. Get Quote Model -->

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="related_product">
                <h5>Related Product</h5>
                <div class="row">
                    <?php $__currentLoopData = $randervice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rnservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="related_productbox">
                            <a href="<?php echo e(url('/services/'.$rnservice->url)); ?>">
                                <div class="related_productboximg">
                                    <?php if(!empty($rnservice->service_image)): ?>
                                    <img
                                        src="<?php echo e(url('/images/backend_images/repair_service_images/large/'.$rnservice->service_image)); ?>">
                                    <?php else: ?>
                                    <img src="<?php echo e(url('/images/frontend_images/images/default.jpg')); ?>">
                                    <?php endif; ?>
                                </div>
                                <h5> <?php echo e($rnservice->service_name); ?> </h5>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
            <div id="ser_professionals" class="serview_conbox">
                <div class="row">
                    <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <a href="<?php echo e(url('/profile/'.$v->id.'/user')); ?>">
                            <div class="fireman">
                                <div class="boxuser_pic">
                                    <img src="<?php echo e(url('images/user.png')); ?>">
                                </div>
                                <div class="boxuser_details">
                                    <h5
                                        style="overflow: hidden;-webkit-line-clamp: 1;display: -webkit-box;-webkit-box-orient: vertical;">
                                        <?php echo e($v->first_name); ?> <?php echo e($v->last_name); ?></h5>
                                    <p><?php $__currentLoopData = \App\Cities::where('id', $v->city)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($city->name); ?>,
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e($v->country); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
        </div>
    </div>

    

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/repair_services/single_repair_service.blade.php ENDPATH**/ ?>