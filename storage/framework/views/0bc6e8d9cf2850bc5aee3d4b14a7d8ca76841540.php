<?php $__env->startSection('content'); ?>

<?php
 
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
?>

<style>
#filediv {
    display: inline-block !important;
}

#file {
    color: green;
    padding: 5px;
    border: 1px dashed #123456;
    background-color: #f9ffe5
}

#noerror {
    color: green;
    text-align: left
}

#error {
    color: red;
    text-align: left
}

#img {
    width: 17px;
    border: none;
    height: 17px;
    margin-left: 10px;
    cursor: pointer;
}

.abcd img {
    height: 100px;
    width: 100px;
    padding: 5px;
    border-radius: 10px;
    border: 1px solid #e8debd
}

#close {
    vertical-align: top;
    background-color: red;
    color: white;
    border-radius: 5px;
    padding: 4px;
    margin-left: -13px;
    margin-top: 1px;
}
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Add New Property</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Property</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box box-purple">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="PropertyInformationData">
                            <form enctype="multipart/form-data" method="post"
                                action="<?php echo e(url('/admin/add-new-property')); ?>" name="add_property" id="add_property"
                                novalidate="novalidate">
                                <?php echo e(csrf_field()); ?>


                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="SectionOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                    href="#PropertyDetailSection" aria-expanded="true"
                                                    aria-controls="PropertyDetailSection">
                                                    <strong>1. Property Details</strong>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="PropertyDetailSection" class="panel-collapse collapse in"
                                            role="tabpanel" aria-labelledby="SectionOne">
                                            <div class="panel-body">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="row">
                                                        <div class="property_basic col-sm-12 col-md-12">
                                                            <div class="property_heading col-xs-12 col-md-12">
                                                                <h4><strong>Property Basic Details</strong></h4>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Property For">Property For</label> <span
                                                                        class="pull-right"
                                                                        id="error_property_for"></span>
                                                                    <select name="property_for" id="property_for"
                                                                        class="form-control" style="width: 100%;"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected>Properties</option>
                                                                        <?php $__currentLoopData = $servicetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($services->id); ?>">
                                                                            <?php echo e($services->service_name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Property Name">Property Name</label>
                                                                    <span class="pull-right"
                                                                        id="error_property_name"></span>
                                                                    <input type="text" name="property_name"
                                                                        id="property_name" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Url">Url</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Url</span>
                                                                        <input type="text" name="slug" id="slug"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Property Type">Property Type</label>
                                                                    <span class="pull-right"
                                                                        id="error_property_type"></span>
                                                                    <select name="property_type" id="PropertyType"
                                                                        class="form-control" style="width: 100%;"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected>Select Property Type
                                                                        </option>
                                                                        <?php $__currentLoopData = $propertytype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ptype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option
                                                                            value="<?php echo e($ptype->property_type_code); ?>">
                                                                            <?php echo e($ptype->property_type); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label name="Expected Total Price">Expected Total
                                                                        Price</label>
                                                                    <input name="property_price" id="property_price"
                                                                        type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label name="Builder">Builder</label>
                                                                    <select name="builder" id="NewBuilderName"
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <option value="" selected>Select Builder
                                                                        </option>
                                                                        <option value="addNewBuilder"> + Add New
                                                                        </option>
                                                                        <?php $__currentLoopData = $getBuilder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($b->id); ?>">
                                                                            <?php echo e($b->first_name); ?> <?php echo e($b->last_name); ?>

                                                                        </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label name="Agent">Agent</label>
                                                                    <select name="agent" id="NewAgentName"
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <option value="" selected>Select Agent</option>
                                                                        <?php $__currentLoopData = $getAgent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($a->id); ?>">
                                                                            <?php echo e($a->first_name); ?> <?php echo e($a->last_name); ?>

                                                                        </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="AddBuilderData" style="background:#ddd;"
                                                            class="builder_info col-sm-12 col-md-12 hidden">
                                                            <div class="builder_heading col-xs-12 col-md-12">
                                                                <h4><strong>Add Builder/Agent/Owner</strong></h4>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="First Name">First Name</label>
                                                                    <input type="text" name="first_name" id="first_name"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Last Name">Last Name</label>
                                                                    <input type="text" name="last_name" id="last_name"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Usertype">Usertype</label>
                                                                    <select name="usertype" id="usertype"
                                                                        class="form-control">
                                                                        <option selected value="">Select Usertype
                                                                        </option>
                                                                        <option value="B">Builder</option>
                                                                        <option value="A">Agent</option>
                                                                        <option value="U">Owner</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Email">Email</label>
                                                                    <input type="text" name="email" id="email"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="Password">Password</label>
                                                                    <input type="password" name="password" id="password"
                                                                        value="<?php echo generate_string($permitted_chars, 20); ?>"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-4 col-md-2">
                                                                <div class="form-group">
                                                                    <label>Code</label>
                                                                    <select name="phonecode" id="phonecode"
                                                                        class="form-control">
                                                                        <?php $__currentLoopData = $phonecode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($code->phonecode); ?>">
                                                                            <?php echo e($code->iso3); ?>

                                                                            &nbsp;<?php echo e($code->phonecode); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Phone</label>
                                                                    <input type="tel" name="phone" id="phone"
                                                                        class="form-control" placeholder="Phone">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="form-group">
                                                                    <button type="submit" name="submit_user"
                                                                        id="submit_new_user"
                                                                        class="btn btn-md btn-info pull-right">Add
                                                                        User</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="PropertyInfo"
                                                            class="property_info col-sm-12 col-md-12 hidden">
                                                            <div class="property_heading col-xs-12 col-md-12">
                                                                <h4><strong>Property Information</strong></h4>
                                                            </div>
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="Description">Description</label> <span
                                                                        class="pull-right"
                                                                        id="error_property_description"></span>
                                                                    <textarea name="description" id="description"
                                                                        class="form-control my-editor"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <input type="checkbox" name="feature"
                                                                            id="feature" class="flat-red" value="1">
                                                                        Featured <small class="text-purple pl-1">( If
                                                                            you check this set Featured Property
                                                                            )</small>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <input type="checkbox" name="commercial"
                                                                            id="commercial" class="flat-red" value="1">
                                                                        Commercial <small class="text-purple pl-1">( If
                                                                            you check this set Commercial Property
                                                                            )</small>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div id="MapPassed" class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Map Passed">Map Passed</label>
                                                                    <select name="map_passed" id="map_passed"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="OpenSides" class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Open Sides">No. of Open Sides</label>
                                                                    <select name="open_sides" id="open_sides"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Open Sides
                                                                        </option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label name="Property Area">Property Area (in sq.
                                                                        ft)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">sq/ft</span>
                                                                        <input name="property_area" id="property_area"
                                                                            type="text" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="WidthRoadFacing" class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Width of Road Facing">Width of Road
                                                                        Facing the Plot</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">in Meters</span>
                                                                        <input name="width_road_facing"
                                                                            id="width_road_facing" type="text"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="FurnishStatus" class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Furnish Type">Furnish Type</label>
                                                                    <select name="furnish_type" id="furnish_type"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Furnish Type
                                                                        </option>
                                                                        <option value="F">Fully Furnished</option>
                                                                        <option value="S">Semi Furnished</option>
                                                                        <option value="U">Unfurnished</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Transection Type">Transaction
                                                                        Type</label>
                                                                    <select name="transection_type"
                                                                        id="transection_type" class="form-control">
                                                                        <option value="" selected>Select Transaction
                                                                            Type</option>
                                                                        <option value="New Booking">New Booking</option>
                                                                        <option value="Resale">Resale</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-12 col-md-4">
                                                                <div class="form-group">
                                                                    <label>Construction Status</label>
                                                                    <select name="construction_status"
                                                                        id="construction_status" class="form-control">
                                                                        <option value="" selected>Select Construction
                                                                            Status</option>
                                                                        <option value="UC">Under Construction</option>
                                                                        <option value="RM">Ready to Move</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="FloorNo" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Floor no.">Floor no.</label>
                                                                    <select name="floor_no" id="floor_no"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Floor no.
                                                                        </option>
                                                                        <?php for($i=1; $i<165; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="TotalFloor" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Total Floors">Total Floors</label>
                                                                    <select name="total_floors" id="total_floors"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Total Floors
                                                                        </option>
                                                                        <?php for($i=1; $i<165; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="AppleTrees" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Apple Trees">Trees</label>
                                                                    <select name="trees" id="trees"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Trees</option>
                                                                        <?php for($i=1; $i<1001; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="Bedrooms" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Bedrooms">Bedrooms</label>
                                                                    <select name="bedrooms" id="bedrooms"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Bedrooms
                                                                        </option>
                                                                        <?php for($i=1; $i<250; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="Bathrooms" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Bathrooms">Bathrooms</label>
                                                                    <select name="bathrooms" id="bathrooms"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Bathrooms
                                                                        </option>
                                                                        <?php for($i=1; $i<150; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="Balconies" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Balconies">Balconies</label>
                                                                    <select name="balconies" id="balconies"
                                                                        class="form-control">
                                                                        <option value="" selected>Select Balconies
                                                                        </option>
                                                                        <?php for($i=1; $i<165; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="PWashroom" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Personal Washroom">Personal
                                                                        Washroom</label>
                                                                    <select name="p_washroom" id="p_washroom"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="Cafeteria" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Cafeteria">Pantry/Cafeteria</label>
                                                                    <select name="cafeteria" id="cafeteria"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="IsRoadFacing" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Main Road Facing">Is Main Road
                                                                        Facing</label>
                                                                    <select name="roadfacing" id="roadfacing"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="CornerShop" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Corner Shop">Corner Shop</label>
                                                                    <select name="corner_shop" id="corner_shop"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="BoundryWall" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Boundry Wall Madep">Boundry Wall
                                                                        Made</label>
                                                                    <select name="boundrywall" id="boundrywall"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div id="PShowroom" class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Personal Showroom">Personal
                                                                        Showroom</label>
                                                                    <select name="pshowroom" id="pshowroom"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <option value="1">Yes</option>
                                                                        <option value="0">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label for="Property Age">Property Age</label>
                                                                    <select name="property_age" id="property_age"
                                                                        class="form-control">
                                                                        <option value="" selected>Select</option>
                                                                        <?php for($i=1; $i<100; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>">
                                                                            <?php echo $i; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="property_address col-sm-12 col-md-12">
                                                            <div class="property_heading col-xs-12 col-md-12">
                                                                <h4><strong>Property Address</strong></h4>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Property Address">Property Address
                                                                        1</label>
                                                                    <textarea name="property_address1"
                                                                        id="property_address1" class="form-control"
                                                                        rows="3"
                                                                        placeholder="Address Line 1"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Property Address">Property Address
                                                                        2</label>
                                                                    <textarea name="property_address2"
                                                                        id="property_address2" class="form-control"
                                                                        rows="3"
                                                                        placeholder="Address Line 2"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Locality">Locality</label>
                                                                    <input type="text" name="locality" id="locality"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Country">Country</label> <span
                                                                        class="pull-right"
                                                                        id="error_property_country"></span>
                                                                    <select name="country" id="country"
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        style="width: 100%;" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        <option value="" selected>Select Country
                                                                        </option>
                                                                        <?php $__currentLoopData = $countryname; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($country->iso2); ?>">
                                                                            <?php echo e($country->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="State">State</label> <span
                                                                        class="pull-right"
                                                                        id="error_property_state"></span>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="state" id="state" style="width: 100%;"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected>Select State</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="City">City</label> <span
                                                                        class="pull-right"
                                                                        id="error_property_city"></span>
                                                                    <select
                                                                        class="form-control select2 select2-hidden-accessible"
                                                                        name="city" id="city" style="width: 100%;"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        <option value="" selected>Select City</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="Zipcode/Postal Code">Zipcode/Postal
                                                                        Code</label>
                                                                    <input name="zipcode" id="zipcode" type="text"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- Rows -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="SectionTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    data-parent="#accordion" href="#PropertyAmenities"
                                                    aria-expanded="false" aria-controls="PropertyAmenities">
                                                    <strong>2. Property Amenities</strong>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="PropertyAmenities" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="SectionTwo">
                                            <div class="panel-body">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="row">
                                                        <div class="property_basic col-sm-12 col-md-12">
                                                            <div class="property_heading col-xs-12 col-md-12">
                                                                <h4><strong>Property Amenities</strong></h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-12">
                                                            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-xs-6 col-md-4">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <input type="checkbox" name="amenity[]"
                                                                            id="<?php echo preg_replace('/[^a-zA-Z0-9-]/','' ,strtolower($a->name)); ?>"
                                                                            class="flat-red"
                                                                            value="<?php echo e($a->amenity_code); ?>">
                                                                        <?php echo e($a->name); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="SectionThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    data-parent="#accordion" href="#PropertyImages"
                                                    aria-expanded="false" aria-controls="PropertyImages">
                                                    <strong>3. Property Images</strong>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="PropertyImages" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="SectionThree">
                                            <div class="panel-body">
                                                <div class="property_images col-sm-12 col-md-12">
                                                    <div class="property_heading">
                                                        <h4><strong>Property Images</strong></h4>
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- <label for="Property Images">Add Images</label> -->
                                                        <!-- <input type="file" id="property_images" name="property_images"> -->
                                                        <div class="add_image">
                                                            <input type="button" id="add_more" class="btn btn-info"
                                                                value="add image" />
                                                            <!-- <i class="fas fa-camera"></i> -->
                                                        </div>
                                                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="SectionFour">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#SeoSection" aria-expanded="false" aria-controls="SeoSection">
                                                <strong>4. SEO</strong>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="SeoSection" class="panel-collapse collapse" role="tabpanel" aria-labelledby="SectionFour">
                                            <div class="panel-body">
                                                <div class="col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="Meta Title">Meta Title</label>
                                                        <input type="text" name="meta_title" id="meta_title"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="Meta Description">Meta Description</label>
                                                        <textarea name="meta_description" id="meta_description"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="Meta Keywords">Meta Keywords</label>
                                                        <input type="text" name="meta_keywords" id="meta_keywords"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="submit" id="AddPropertyAdmin" class="btn btn-success btn-lg pull-right"
                                        value="Submit Property">
                                    <span class="pull-right" id="error_msg_btn"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLayout.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/admin/property/add-property.blade.php ENDPATH**/ ?>