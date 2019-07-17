<?php $__env->startSection('content'); ?>

<style>
   .box{width:600px;margin:0 auto;border:1px solid #ccc;}
   .has-error{border-color:#FF0000 !important;background-color:#ffff99;}
</style>

<div class="vender_formsec">
    <div class="vender_header">
        <a class="backtohome" href="<?php echo e(url('/')); ?>">Back To Home</a>
    </div>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 col-md-8 col-lg-8 col-xl-8 vender_formleft p-0">
                <div class="mainform">
                    
                    <form id="regForm" enctype="multipart/form-data" name="listproperty" method="post"action="<?php echo e(url('/list-property')); ?>">
                    <?php echo e(csrf_field()); ?>

                        <div class="stepstrip">
                            <ul>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Personal Details</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Property Location</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Property Information</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Upload Images</p>
                                </li>
                                <li class="step"><i class="far fa-check-circle"></i>
                                    <p>Submit</p>
                                </li>
                            </ul>
                        </div>
                        <div class="mainform_inn">
                            <!-- One "tab" for each step in the form: -->
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
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading">Personal Details</h6>
                                    <label>I am</label>
                                    <div class="radioblock">
                                        <ul>
                                            <li>
                                                <label class="radio_container">Owner
                                                    <input type="radio" id="UserType1" checked="checked"
                                                        name="user_type" value="U">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio_container"> Agent
                                                    <input type="radio" id="UserType2" name="user_type" value="A">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="radio_container"> Builder
                                                    <input type="radio" id="UserType3" name="user_type" value="B">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Name</label>
                                        <input type="text" id="ListName" name="name" class="form-control emptyformvalidation"
                                            placeholder="Enter your name">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-3 col-xs-6">
                                            <label class="title_txt">Country Code</label>
                                            <select name="phonecode" id="phonecode" class="form-control">
                                                <?php $__currentLoopData = $phonecode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($pcode->phonecode); ?>"><?php echo e($pcode->iso3); ?> <?php echo e($pcode->phonecode); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-9 col-xs-6">
                                            <label class="title_txt">Mobile</label><span class="float-right" id="error_listphone"></span>
                                            <input type="tel" id="ListPhone" name="phone" class="form-control emptyformvalidation"
                                                placeholder="Enter mobile number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Email</label><span class="float-right" id="error_email"></span>
                                        <input type="email" id="ListEmail" name="email" required class="form-control emptyformvalidation"
                                            placeholder="Enter your email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                </div>
                                <div class="formboxed">
                                    <h6 class="formheading">About Property Details</h6>
                                    <label class="title_txt">Property For</label>
                                    <div class="radioblock">
                                        <ul>
                                            <li>
                                                <label class="radio_container">Sale
                                                    <input type="radio" id="PropertyFor4" checked="checked"
                                                        name="property_for" value="4">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                            <li>
                                            <label class="radio_container">Rent
                                                    <input type="radio" id="PropertyFor3"
                                                        name="property_for" value="3">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Property Type</label>
                                        <select id="PropertyType" name="property_type" class="form-control emptyformvalidation">
                                            <option value="" selected>Select Property Type</option>
                                            <?php $__currentLoopData = \App\PropertyTypes::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pt->property_type_code); ?>"><?php echo e($pt->property_type); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading">Property Location</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Country</label>
                                                <select id="country" name="country" class="form-control emptyformvalidation">
                                                    <option selected value="">Select Country</option>
                                                    <?php $__currentLoopData = \App\Country::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->iso2); ?>"><?php echo e($country->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">State</label>
                                                <select id="state" name="state" class="form-control emptyformvalidation">
                                                    <option selected value="">Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">City</label>
                                                <select id="city" name="city" class="form-control emptyformvalidation">
                                                    <option value="" selected>Select City</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Zip Code</label>
                                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                                    placeholder="Zip Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">Locality</label>
                                        <input type="text" class="form-control emptyformvalidation" name="locality" id="locality"
                                            placeholder="Enter locality">
                                    </div>
                                    <div class="form-group">
                                        <label class="title_txt">House no./Flat no.</label>
                                        <input type="text" class="form-control" name="houseno" id="houseno"
                                            placeholder="Enter House no / Flat no">
                                    </div>
                                    <!-- <div class="formmap">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13998.63502405659!2d77.12001999999998!3d28.6998528!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1551258837470"
                                            width="600" height="250" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                    </div> -->
                                    <div class="form-group">
                                        <label class="checkbox_container"> I am posting this property 'exclusively' on
                                            IPC
                                            <input type="checkbox" name="condition" id="condition_check" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="formtab">
                                <!-- Form Box Start Here (Property Details) -->
                                <div class="formboxed">
                                    <h6 class="formheading">Property Details</h6>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Property Name</label>
                                                <input type="text" name="property_name" id="property_name"
                                                    class="form-control emptyformvalidation" placeholder="Enter property name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                                            <div class="form-group d-none">
                                                <label class="title_txt">Property URL</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">URL</div>
                                                    </div>
                                                    <input type="text" name="slug" class="form-control" id="slug">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Property Description</label>
                                                <textarea name="description" id="ListPropertyDescription"
                                                    class="form-control my-editor emptyformvalidation" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="checkbox_container"> Featured Property
                                                    <input type="checkbox" name="featured" id="featured" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="checkbox_container"> Commercial Property
                                                    <input type="checkbox" name="commercial" id="commercial" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="PropertyArea" class="col-12 col-sm-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Property Area (in sq.ft.)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">sq/ft</div>
                                                    </div>
                                                    <input type="text" name="property_area" class="form-control" id="property_area">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="MapPassed" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Map Passed</label>
                                                <select id="map_passed" name="map_passed"
                                                    class="form-control">
                                                    <option selected value="">Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="OpenSides" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Open Sides</label>
                                                <select id="open_sides" name="open_sides"
                                                    class="form-control">
                                                    <option value="" selected>Select Open Sides</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="FurnishStatus" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Furnish Type</label>
                                                <select id="furnish_type" name="furnish_type"
                                                    class="form-control">
                                                    <option value="" selected>Select Furnish Type</option>
                                                    <option value="F">Fully Furnished</option>
                                                    <option value="S">Semi Furnished</option>
                                                    <option value="U">Unfurnished</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="TransectionType" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Transaction Type</label>
                                                <select id="transection_type" name="transection_type"
                                                    class="form-control">
                                                    <option selected value="">Select Transaction Type</option>
                                                    <option value="New Booking">New Booking</option>
                                                    <option value="Resale">Resale</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="ConstructionStatus" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Select Construction Status</label>
                                                <select id="construnction_status" name="construnction_status"
                                                    class="form-control">
                                                    <option selected value="">Select</option>
                                                    <option value="Ready to Move">Ready to Move</option>
                                                    <option value="Under Construction">Under Construction</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="FloorNo" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Floor no.</label>
                                                <select name="floor_no" id="floor_no" class="form-control">
                                                    <option value="" selected>Select Floor no.</option>
                                                    <?php for($i=1; $i<165; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="TotalFloor" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Total Floor</label>
                                                <select name="total_floors" id="total_floors" class="form-control">
                                                    <option value="" selected>Select Total Floors</option>
                                                    <?php for($i=1; $i<165; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="AppleTrees" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Trees</label>
                                                <select name="trees" id="trees" class="form-control">
                                                    <option value="" selected>Select Trees</option>
                                                    <?php for($i=1; $i<1001; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Bedrooms" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Bedrooms</label>
                                                <select name="bedrooms" id="bedrooms" class="form-control">
                                                    <option value="" selected>Select Bedrooms</option>
                                                    <?php for($i=1; $i<250; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Bathrooms" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Bathrooms</label>
                                                <select name="bathrooms" id="bathrooms" class="form-control">
                                                    <option value="" selected>Select Bathrooms</option>
                                                    <?php for($i=1; $i<150; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Balconies" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Balconies</label>
                                                <select name="balconies" id="balconies" class="form-control">
                                                    <option value="" selected>Select Balconies</option>
                                                    <?php for($i=1; $i<165; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="PWashroom" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Personal Washroom</label>
                                                <select name="p_washroom" id="p_washroom" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="Cafeteria" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Pantry/Cafeteria</label>
                                                <select name="cafeteria" id="cafeteria" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="PShowroom" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Personal Showroom</label>
                                                <select name="pshowroom" id="pshowroom" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="PropertyAge" class="col-12 col-md-6 col-xl-6">
                                            <div class="form-group">
                                                <label class="title_txt">Property Age</label>
                                                <select name="property_age" id="property_age" class="form-control">
                                                    <option value="" selected>Select</option>
                                                    <?php for($i=1; $i<100; $i++) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Form Box end here (Property Details) -->

                                <!-- Form Box Start here (Property Price) -->
                                <div class="formboxed">
                                    <h6 class="formheading">Share commercials for your property</h6>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-xl-12">
                                            <div class="form-group">
                                                <label class="title_txt">Property Price (Price must be in your local currency)</label>
                                                <input type="text" class="form-control" name="property_price" id="property_price" placeholder="Property Price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /. Form Box end here (Property Price) -->
                            </div>
                            <div class="formtab">
                                <div class="formboxed">
                                    <h6 class="formheading text-center">Upload Property Images</h6>
                                    <div class="upload_field ">
                                        <div class="upload_fieldinn">
                                            <input type="button" class="custom-file-input" id="add_more"
                                                value="add image" />
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <small class="mt-3" style="display:block;">(max limit 5 MB per image)</small>
                                    </div>
                                    <div class="uploaded_images">
                                        <ul class="add_image">
                                        </ul>
                                    </div>
                                    <div class="subtxtouter">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="subtxt">
                                                    <p><i class="far fa-check-circle"></i><span class="bold">Atleast 8
                                                            photos</span> will increase property quality score by 15%
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="subtxt">
                                                    <p><i class="far fa-check-circle"></i><span class="bold">Hall,
                                                            Bedroom, Kitchen and Bathroom</span> photos will get more
                                                        points in quality score</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vender_footer">
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 venderbanner">
                <div class="vender_right">
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/frontend/list_property.blade.php ENDPATH**/ ?>