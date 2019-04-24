<?php 

use App\Http\Controllers\Controller;
$footerProperties = Controller::footersection();

?>

<footer>
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/choice.svg">
                        <h5>Maximum Choices</h5>
                        <p>5 Lac + & counting. New properties every hour to 
                            help buyers find the right home</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right border_bottom">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/trust.svg">
                        <h5>Buyers Trust Us</h5>
                        <p>2 million users visit us every month for 
                                their buying and renting needs</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right border_bottomb">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/seller.svg">
                        <h5>Seller Prefer Us</h5>
                        <p>7,000 new properties posted daily, making us
                                the biggest platform to sell & rent properties</p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/guidance.svg">
                        <h5>Expert Guidance</h5>
                        <p>Advice from the largest panel of 
                                industry experts to help you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_menu">
        <div class="container">
            <ul>
                <li><a href="#">Buy</a></li>
                <li><a href="#">Rent</a></li>
                <li><a href="#">Sell</a></li>
                <li><a href="#">Tools & Advice</a></li>
                <li><a href="#">Packages</a></li>
                <li><a href="#">Properties in India</a></li>
                <li><a href="#">Home Loan</a></li>                                             
            </ul>
        </div>
    </div>

    <div class="footer_bottom">
        
        <div class="container">
                <div class="footer_web">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="footer_box">
                        <h5>INDIA PROPERTY CLINIC</h5>
                        <p>India Property Clinic – Property portal and has been the most 
                            preferred property site in India, by independent surveys. 
                            The portal provides a platform for property buyers and sellers to 
                            locate properties of interest and source 
                            information on the real estate space in a transparent and 
                            instantly recognizable manner.</p>
                            <a class="readmore" href="#">Read More...</a>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-8">
                        <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="footer_box">
                        <h5>INDIA PROPERTY CLINIC</h5>
                        <p>A-16, 2 nd Floor, Sector 6, Noida, Uttar Pradesh 201301</p>
                        <p>+91-9555396371</p>
                        <p><a href="mailto:info@indiapropertyclinic.com">info@indiapropertyclinic.com</a></p>
                        <p><a href="#">https://indiapropertyclinic.com</a></p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="footer_box">
                        <h5>OTHER SERVICES</h5>
                        <div class="oter_ser">
                            <a href="#">Plumbing Services</a>
                            <a href="#">Welding Services</a>
                            <a href="#">Carpenter Services</a>
                            <a href="#">Architecture Services</a>
                            <a href="#">Aluminium Fabricators Services</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="footer_box">
                        <h5>LATEST LISTINGS</h5>
                        <ul>
                            <?php $counter=0; ?>
                            <?php $__currentLoopData = $footerProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $footerproperty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $counter++ ?>
                            <?php if($counter <= 2): ?>
                            <li>
                                <a href="<?php echo e(url('/properties/'.$footerproperty->property_url)); ?>">
                                    <span>
                                        <img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$footerproperty->image_name)); ?>">
                                    </span>
                                    <h6>
                                    <?php if(!empty($footerproperty->city_name)): ?>
                                    <span><?php echo e($footerproperty->city_name); ?></span> 
                                    <?php endif; ?>
                                    </h6>
                                    <p><?php echo e($footerproperty->parea); ?> Square Ft</p>
                                    <h5>INR <?php echo e($footerproperty->property_price); ?></h5>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <a href="<?php echo e(url('/properties')); ?>">View All...</a>
                        </ul>
                    </div>
                </div>
                </div>
                </div>
            </div>
                </div><!-- Web View end -->
        </div><!-- footer container-->

        <div class="footer_mob">
                <div class="accordion" id="footerAccordian">
                        <div class="card">
                          <div id="headingOne">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                INDIA PROPERTY CLINIC <i class="fas fa-angle-down"></i>
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#footerAccordian">
                            <div class="card-body">
                                    <div class="footer_box">
                                        <p>India Property Clinic – Property portal and has been the most 
                                            preferred property site in India, by independent surveys. 
                                            The portal provides a platform for property buyers and sellers to 
                                            locate properties of interest and source 
                                            information on the real estate space in a transparent and 
                                            instantly recognizable manner.</p>
                                            <a class="readmore" href="#">Read More...</a>
                                    </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div id="headingTwo">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                CONTACT INFO <i class="fas fa-angle-down"></i>
                              </button>
                            </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#footerAccordian">
                            <div class="card-body">
                                <div class="footer_box">
                                    <p>A-16, 2 nd Floor, Sector 6, Noida, Uttar Pradesh 201301</p>
                                    <p>+91-9555396371</p>
                                    <p><a href="mailto:info@indiapropertyclinic.com">info@indiapropertyclinic.com</a></p>
                                    <p><a href="#">https://indiapropertyclinic.com</a></p>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div id="headingThree">
                            <h2 class="mb-0">
                              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                OTHER SERVICES <i class="fas fa-angle-down"></i>
                              </button>
                            </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#footerAccordian">
                            <div class="card-body">
                                <div class="footer_box">
                                    <div class="oter_ser">
                                        
                                    <a href="#">Plumbing Services</a>
                                    <a href="#">Welding Services</a>
                                    <a href="#">Carpenter Services</a>
                                    <a href="#">Architecture Services</a>
                                    <a href="#">Aluminium Fabricators Services</a>
                                        
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                            <div id="headingFour">
                                <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    LATEST LISTINGS <i class="fas fa-angle-down"></i>
                                </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#footerAccordian">
                                <div class="card-body">
                                        <div class="footer_box">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <span>
                                                            <img src="/images/frontend_images/images/product1.jpg">
                                                        </span>
                                                        <h6>Bangkok, Sathorn</h6>
                                                        <p>160 Square Ft</p>
                                                        <h5>INR 2,100,000</h5>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span>
                                                            <img src="/images/frontend_images/images/product1.jpg">
                                                        </span>
                                                        <h6>Bangkok, Sathorn</h6>
                                                        <p>160 Square Ft</p>
                                                        <h5>INR 2,100,000</h5>
                                                    </a>
                                                </li>
                                                <a href="#">View All...</a>
                                            </ul>
                                        </div>
                                </div>
                            </div>
                            </div>
                      </div>
        </div>

        <div class="container">
            <div class="copyright">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright_menu">
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Home Loan</a></li>
                        </ul>
                    
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> | India Property Clinic. All Rights Reserved.</p>
                </div> 
                </div>
                <div class="col-lg-4">
                    <div class="social_link social_linkfoot">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</footer><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/footer_design.blade.php ENDPATH**/ ?>