<?php /* D:\IndiaProperty\IndiaPropertyClinic\resources\views/frontend/home_loan_application.blade.php */ ?>
<?php $__env->startSection('content'); ?>

<div class="smart_container">
    <div class="loanbanner" style="<?php echo e(asset('/images/frontend_images/images/loanbg-01.svg')); ?>">
        <div class="container">
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
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-8 col-xl-8">
                    <div class="loanbanner_left">
                        <h3>Lets find you the best home loan deal.</h3>
                        <h6>Calculate EMI for the loan amount you require</h6>
                        <p>Calculate your loan EMI instantly by submitting your details below</p>
                        <a href="" data-toggle="modal" data-target="#homeLoan" class="apply_loanbtn">Apply Home Loan</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4 col-xl-4">
                    <div class="loanbann_right">
                        <img height="250" src="<?php echo e(asset('/images/frontend_images/images/loanbanner-01.svg')); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="homeloan_outer">
        <div class="container">
            <h3>EMI Calculator for Home Loan</h3>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6 col-xl-6">
                        <form id="ecww-formwrapper" class="no-pad">
                                <div id="ecww-form">
                                    <div class="form-group">
                                        <label for="ecww-loanamount" class="title_txt">Loan Amount</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">₹</div>
                                            </div>
                                            <input type="text" class="form-control ecww-userinput" id="ecww-loanamount" value="250,000" tabindex="1" placeholder="Loan Amount"> 
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ecww-loaninterest" class="title_txt">Interest Rate</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                            <input type="text" class="form-control ecww-userinput" id="ecww-loaninterest" value="5.25" tabindex="2" placeholder="Interest Rate"> 
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-lg-5 col-xl-5">
                                            <div class="form-group">
                                                <label for="ecww-loanterm" class="title_txt">Select Loan Tenure</label>
                                                <div class="form-group">
                                                    <div class="ecww-tenure-choice">
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-dark active">
                                                                <input type="radio" name="ecww-loantenure" id="ecww-loanyears" tabindex="4" autocomplete="off" checked="">Yr </label>
                                                            <label class="btn btn-dark">
                                                                <input type="radio" name="ecww-loantenure" id="ecww-loanmonths" tabindex="5" autocomplete="off">Mo </label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-lg-7 col-xl-7">
                                            <div class="form-group">
                                                    <label class="title_txt">Please Type selected yr/mo </label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Yr/Mo</div>
                                                    </div>
                                                    <input type="text" class="form-control ecww-userinput" id="ecww-loanterm" value="15" tabindex="3" placeholder="Loan Tenure"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    

                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="calview">
                                <ul>
                                    <li id="ecww-monthlypayment">
                                        <h6>Loan EMI</h6>
                                        <p>₹ 16,607</p>
                                    </li>
                                    <li id="ecww-totalinterest">
                                        <h6>Total Interest Payable</h6>
                                        <p>₹ 97,858</p>
                                    </li>
                                    <li id="ecww-totalamount">
                                        <h6>Total of Payments <span>(Principal + Interest)</span></h6>
                                        <p>₹ 5,97,858</p>
                                    </li>
                                </ul>
                            </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-6 col-xl-6">
                        <div id="ecww-piechart" class="highcharts-container no-pad" >
                                <div class="highcharts-container"  style="position: relative; overflow: hidden; width: 454px; height: 279px; text-align: left; line-height: normal; z-index: 0; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); font-family: Helvetica, Arial, Verdana, sans-serif; font-size: 13px; font-weight: normal; color: rgb(136, 136, 136);">
                                    
                                </div>
                            </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-12 col-xl-12 text-center">
                <div class="apply_strip">
                    <a href="" data-toggle="modal" data-target="#homeLoan" class="apply_loanbtn">Apply Home Loan</a>
                </div>
                </div>

            </div>

            <div id="datatable">
                
            </div>

        </div>


    </div>
</div>

<!-- Modal Home Loan -->
<div class="modal fade bd-example-modal-lg" id="homeLoan" tabindex="-1" role="dialog" aria-labelledby="homeLoanTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="homeLoanTitle">We just need a few details to match you with the right home loan product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="formboxed mb-0">
                    <h6 class="formheading">Fill your Basic Details</h6>
                    <form name="home_loan_form" id="home_loan_form" method="post" action="<?php echo e(url('/Apply-Home-Loan')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Loan Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text select_padding">
                                                <select class="select_custom" id="">
                                                    <option selected="">$</option>
                                                    <option value="1">₹</option>
                                                    <option value="2">AED</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="text" name="loan_amount" id="loan_amount" class="form-control" placeholder="Loan Amount"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Loan Tenure</label>
                                    <div class="input-group">
                                        <input type="text" name="loan_tenure" id="loan_tenure" class="form-control" placeholder="5 years"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Your Age</label>
                                    <div class="input-group">
                                        <input type="text" name="your_age" id="your_age" class="form-control" placeholder="20 years"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Is your property identified</label>
                                    <select id="property_identify" name="property_identify" class="form-control">
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Property City</label>
                                    <input type="text" id="property_city" name="property_city" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-4">
                                <div class="form-group">
                                    <label class="title_txt">Property Cost</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text select_padding">
                                                <select class="select_custom" id="">
                                                    <option selected="">$</option>
                                                    <option value="1">₹</option>
                                                    <option value="2">AED</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="text" name="property_cost" id="property_cost" class="form-control" placeholder="200000"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Occupation Type</label>
                                        <select name="occupation" id="occupation" class="form-control">
                                            <option value="Salaried" selected>Salaried</option>
                                            <option value="Self-Employed Professional">Self-Employed Professional</option>
                                            <option value="Self-Employed Business">Self-Employed Business</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Your Monthly income</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text select_padding">
                                                    <select class="select_custom" id="">
                                                        <option selected="">$</option>
                                                        <option value="1">₹</option>
                                                        <option value="2">AED</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="text" name="monthly_income" id="monthly_income" class="form-control" placeholder="monthly income"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Current Total EMI</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text select_padding">
                                                    <select class="select_custom" id="">
                                                        <option selected="">$</option>
                                                        <option value="1">₹</option>
                                                        <option value="2">AED</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="text" name="total_emi" id="total_emi" class="form-control" placeholder="10000"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Full Name(as Per PAN)</label>
                                        <div class="input-group">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Email id</label>
                                        <div class="input-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="example@yahoo.com"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-4">
                                    <div class="form-group">
                                        <label class="title_txt">Mobile number</label>
                                        <div class="input-group">
                                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone"> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group apply_strip">
                                        <label class="checkbox_container"> By submitting this form you are accepting IndiaPropertyClinic.com <a href="<?php echo e(url('/')); ?>">Terms & Conditions</a>
                                            <input type="checkbox" name="accept_condition" id="accept_condition" value="1" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="apply_strip">
                                        <button class="apply_loanbtn btn" type="submit">Apply Home Loan</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model home Loan end -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>