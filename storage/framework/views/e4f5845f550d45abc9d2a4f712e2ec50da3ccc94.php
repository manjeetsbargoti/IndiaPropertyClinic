<?php $__env->startSection('content'); ?>

<style>

body {
    background-image: url('../../bg-tan.webp');
    background-attachment: fixed; 
    background-repeat: no-repeat;
    background-position: center center; 
    background-size: cover;
}

/* Multi-Step Form */
* {
    box-sizing: border-box;
}

#ServiceQuery {
    background-color: #fff;
    margin: 40px auto;
    font-family: Raleway;
    padding: 40px;
    width: 100%;
    min-width: 600px;
    font-family: Roboto !important;
}

#ServiceQuery h1 {
    text-align: center;
}

#ServiceQuery p {
    text-align: center;
}

#ServiceQuery h4 {
    padding: 0em 0em 1em 0em;
    text-align: center;
}

#Description textarea {
    min-height: 200px;
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
    box-shadow: 0 5px 6px rgba(0,0,0,0.5);
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
    <section id="section1">
        <div class="container col-md-6 col-md-offset-3">
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
            <!-- MultiStep Form -->
            <form id="ServiceQuery" name="service_request_form" method="post" action="<?php echo e(url('/service/request')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="tab">
                    <h4>What is the location of your project?</h4>
                    <div id="CityName" class="form-group citysearch_outer">
                        <p><img src="<?php echo e(url('marker.webp')); ?>"></p>
                        <label>City Name</label>
                        <input type="text" name="city_name" id="city_name_id" class="form-control emptyformvalidations search_citylocation" placeholder="Enter City">
                        <div id="allcitylist"></div>
                    </div>
                    
                </div>
                <div class="tab">
                    <h4>What kind of work do you need done?</h4>
                    <div id="MainService" class="form-group">
                        <select name="main_service" id="MainServiceList" class="form-control emptyformvalidations">
                            <option value="" selected> -- Select Service -- </option>
                            <?php $__currentLoopData = \App\OtherServices::where('parent_id', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_rservices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($main_rservices->id); ?>"><?php echo e($main_rservices->service_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div id="SubService" class="form-group">
                        <select name="sub_service" id="SubServiceList" class="form-control">
                            <!-- <option value="test">Test</option> -->
                        </select>
                    </div>
                    <div id="SubsService" class="form-group">
                        <select name="subs_service" id="SubsServiceList" class="form-control">
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
                        <textarea class="form-control" name="description" id="description" cols="40"></textarea>
                    </div>
                </div>
                <div class="tab">
                    <h4>Tell us about your location:</h4>
                    <div id="LocationAddress" class="form-group">
                        <label>Address:</label>
                        <textarea class="form-control" name="address" id="address" cols="5"></textarea>
                    </div>
                    
                        <div id="CountryList" class="form-group">
                            <label>Country</label>
                            <select name="country" id="country_list" class="form-control emptyformvalidations">
                                <?php $__currentLoopData = \App\Country::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->iso2); ?>"><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <div class="row">
                        <div id="StatesList" class="form-group col-12 col-sm-6 col-md-6 col-xl-6">
                            <label>State</label>
                            <select name="state" id="StateList" class="form-control emptyformvalidations">
                                <!-- <option>State</option> -->
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-6 col-xl-6">
                            <label>Zipcode/Postal Code</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode/Postal Code">
                        </div>
                    </div>
                </div>
                <div class="tab">
                    <h4>Tell us about your location:</h4>
                    <div id="FullName" class="form-group">
                        <label>Your Full Name</label>
                        <input type="text" name="name" id="name" class="form-control emptyformvalidations" placeholder="Enter your name*">
                    </div>
                    <div id="EmailAddress" class="form-group">
                        <label>Your Email Address</label>
                        <input type="email" name="email" id="email" class="form-control emptyformvalidations" placeholder="Email Address*">
                    </div>
                    <div id="PhoneNumber" class="form-group">
                        <label>Your Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control emptyformvalidations" placeholder="Phone Number*">
                    </div>
                </div>
                <div style="overflow:auto;">
                    <div style="float:right; padding-top: 1em;" class="form-group">
                        <button type="button" class="btn btn-warning navBtn" id="prevBtnRF"
                            onclick="nextPrevRF(-1)">Previous</button>
                        <button type="button" class="btn btn-info navBtn" id="nextBtnRF" onclick="nextPrevRF(1)">Next</button>
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
    </section>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/repair_services/service_request.blade.php ENDPATH**/ ?>