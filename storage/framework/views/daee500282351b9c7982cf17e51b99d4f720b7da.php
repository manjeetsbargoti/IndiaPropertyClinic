<?php 

use App\Http\Controllers\Controller;
$footerProperties = Controller::footersection();

?>

<style>
    .list-property-float{
        position:fixed;
        width:160px;
        height:30px;
        top:10em;
        right:1px;
        z-index: 999;
        background:linear-gradient(to left, #171747, #171747 30%, #F15A27 85%);
        color:#FFF;
        border-radius: 5px;
        text-align:center;
        cursor: pointer;
        /* box-shadow: 2px 2px 3px #999; */
    }
    .list-property-float span {
        position: relative;
        top: 2px;
        font-size: 18px;
    }
    .list-property-float:hover {
        color: #fff;
    }
    .list-business-float{
        position:fixed;
        width:160px;
        height:30px;
        top:13em;
        right:1px;
        z-index: 999;
        background:linear-gradient(to left, #171747, #171747 30%, #F15A27 85%);
        color:#FFF;
        border-radius: 5px;
        text-align:center;
        cursor: pointer;
        /* box-shadow: 2px 2px 3px #999; */
    }
    .list-business-float span {
        position: relative;
        top: 2px;
        font-size: 18px;
    }
    .list-business-float:hover {
        color: #fff;
    }
    .footer-csc a.active {
        color: #f15a27 !important;
    }
</style>

<footer>
    <?php if(Route::current()->getName() == 'repair-services' || Route::current()->getName() == 'service-request'): ?>
    <a href="<?php echo e(url('/list-your-business')); ?>" class="list-business-float">
       <span>List Your Business</span>
    </a>
    <?php elseif(Route::current()->getName() == 'home'): ?>
    <a href="<?php echo e(url('/list-your-business')); ?>" class="list-business-float">
       <span>List Your Business</span>
    </a>
    <br>
    <a href="<?php echo e(url('/list-property')); ?>" class="list-property-float">
       <span>List Your Property</span>
    </a>
    <?php else: ?>
    <a href="<?php echo e(url('/list-property')); ?>" class="list-property-float">
       <span>List Your Property</span>
    </a>
    <?php endif; ?>
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/choice.svg">
                        <!-- <h5>List your Property</h5> -->
                        <p style="padding-top:0.6em;"><a href="<?php echo e(url('/list-property')); ?>" class="btn btn-sm btn-outline-warning"><span class="spinner-grow spinner-grow-sm"></span>&nbsp; List Property</a></p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right border_bottom">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/trust.svg">
                        <!-- <h5>Buyers Trust Us</h5> -->
                        <p style="padding-top:0.6em;"><a href="<?php echo e(url('/list-your-business')); ?>" class="btn btn-sm btn-outline-warning"><span class="spinner-grow spinner-grow-sm"></span>&nbsp; List Business</a></p>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 border_right border_bottomb">
                    <div class="footer_topbox">
                        <img src="/images/frontend_images/images/seller.svg">
                        <h5>Seller Prefer Us</h5>
                        <p>1,000+ new properties posted every week, making us
                            the biggest platform.</p>
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
        <?php // echo $cid; ?>
        <div class="container footer-csc <?php echo e((request()->is('state*') || request()->is('city*')) ? 'd-none':'d-block'); ?>">
            <?php $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']); ?>
            <?php if(!empty($ctryid)): ?>
            <h5 style="color: #000;">Properties in <?php echo e($ctryid->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\State::where('country', $ctryid->iso2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a class="<?php echo e((request()->is('state/'.$s->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/state/'.$s->name.'/properties')); ?>">Properties in <?php echo e($s->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php elseif(!empty($_GET['country'])): ?>
            <?php $cntryname = \App\Country::select('name')->where('iso2', $_GET['country'])->first(); ?>
            <h5 style="color: #000;">Properties in <?php echo e($cntryname->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\State::where('country', $_GET['country'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a class="<?php echo e((request()->is('state/'.$s->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/state/'.$s->name.'/properties')); ?>">Properties in <?php echo e($s->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php else: ?>
            <h5 style="color: #000;">Properties in <?php echo $arr_ip->country; ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\State::where('country', $arr_ip->iso_code)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a class="<?php echo e((request()->is('state/'.$s->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/state/'.$s->name.'/properties')); ?>">Properties in <?php echo e($s->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>

        </div>
        <div class="container footer-csc <?php echo e((request()->is('state*')) ? 'd-block':'d-none'); ?>">
            <?php if(!empty($sid)): ?>
            <h5 style="color: #000;">Properties in <?php echo e($sid->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\Cities::where('state_id', $sid->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a class="<?php echo e((request()->is('city/'.$c->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/city/'.$c->name.'/properties')); ?>">Properties in <?php echo e($c->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php elseif(!empty($_GET['state'])): ?>
            <?php $statname = \App\State::select('name')->where('id', $_GET['state'])->first(); ?>
            <h5 style="color: #000;">Properties in <?php echo e($statname->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\Cities::where('state_id', $_GET['state'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a class="<?php echo e((request()->is('city/'.$c->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/city/'.$c->name.'/properties')); ?>">Properties in <?php echo e($c->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>

        <div class="container footer-csc <?php echo e((request()->is('city*')) ? 'd-block':'d-none'); ?>">
            
            <?php if(!empty($_GET['city'])): ?>
            <?php $stateid = \App\Cities::select('name', 'state_id')->where('id', $_GET['city'])->first(); ?>
            <?php endif; ?>
           
            <?php if(!empty($cid)): ?>
            <h5 style="color: #000;">Properties in <?php echo e($cid->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\Cities::where('state_id', $cid->state_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a  class="<?php echo e((request()->is('city/'.$c->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/city/'.$c->name.'/properties')); ?>">Properties in <?php echo e($c->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php elseif(!empty($_GET['city'])): ?>
            <h5 style="color: #000;">Properties in <?php echo e($stateid->name); ?></h5>
            <ul style="column-count: 4; column-gap: 1em;-webkit-column-count: 4; -webkit-column-gap: 1em; text-align: left;">
                <?php $__currentLoopData = \App\Cities::where('state_id', $stateid['state_id'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="display: block;"><a  class="<?php echo e((request()->is('city/'.$c->name.'/properties')) ? 'active':''); ?>" style="color: #171747; font-weight: 500; font-size: 14px;" href="<?php echo e(url('/city/'.$c->name.'/properties')); ?>">Properties in <?php echo e($c->name); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
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
                                    <h5><?php echo e(config('app.name')); ?></h5>
                                    <p><?php echo e(config('app.address')); ?></p>
                                    <p><?php echo e(config('app.phone')); ?></p>
                                    <p><a href="mailto:<?php echo e(config('app.email')); ?>"><?php echo e(config('app.email')); ?></a></p>
                                    <p><a href="#">https://indiapropertyclinic.com</a></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="footer_box">
                                    <h5>OTHER SERVICES</h5>
                                    <div class="oter_ser">
                                        <?php $__currentLoopData = \App\OtherServices::where('parent_id', 0)->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oths): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(url('/services/'.$oths->url)); ?>"><?php echo e($oths->service_name); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php if($counter <= 2): ?> <li>
                                            <a href="<?php echo e(url('/properties/'.$footerproperty->property_url)); ?>">
                                                <span>
                                                    <?php if(!empty($footerproperty->image_name)): ?><img
                                                        src="<?php echo e(asset('/images/backend_images/property_images/large/'.$footerproperty->image_name)); ?>">
                                                        <?php else: ?>
                                                        <img
                                                        src="<?php echo e(asset('/images/backend_images/property_images/large/default.jpg')); ?>">
                                                        <?php endif; ?>
                                                </span>
                                                <h6>
                                                    <?php if(!empty($footerproperty->city_name)): ?>
                                                    <span><?php echo e($footerproperty->city_name); ?>, <?php echo e($footerproperty->country); ?></span>
                                                    <?php endif; ?>
                                                    
                                                </h6>
                                                <?php if($footerproperty->parea): ?><p><?php echo e($footerproperty->parea); ?> Square Ft</p><?php endif; ?>
                                                <h5><?php $__currentLoopData = \App\Country::where('iso2', $footerproperty->country)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($curen->currency); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e($footerproperty->property_price); ?></h5>
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
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
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
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                CONTACT INFO <i class="fas fa-angle-down"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#footerAccordian">
                        <div class="card-body">
                            <div class="footer_box">
                                <p><?php echo e(config('app.address')); ?></p>
                                <p><?php echo e(config('app.phone')); ?></p>
                                <p><a href="mailto:<?php echo e(config('app.email')); ?>"><?php echo e(config('app.email')); ?></a></p>
                                <p><a href="#">https://indiapropertyclinic.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                OTHER SERVICES <i class="fas fa-angle-down"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#footerAccordian">
                        <div class="card-body">
                            <div class="footer_box">
                                <div class="oter_ser">

                                    <<?php $__currentLoopData = \App\OtherServices::where('parent_id', 0)->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oths): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(url('/services/'.$oths->url)); ?>"><?php echo e($oths->service_name); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                LATEST LISTINGS <i class="fas fa-angle-down"></i>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#footerAccordian">
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
                    <div class="col-sm-12">
                        <p align="justify">India Property Clinic holds no responsibility or liability for the
                            information provided by the property builder/agent/owner on this page. You are requested to
                            cross-check the validity of the information offered here before making any investment in the
                            properties listed here. The team members at India Property Clinic, including its directors,
                            employees, sales agent, or any other member will not be held liable for any loss, expense,
                            cost, or action taken by or against you regarding these properties. All trademarks, logos
                            and names are properties of their respective owners.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_menu">
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo e(url('/terms-condition')); ?>">Terms of Use</a></li>
                                <li><a href="<?php echo e(url('/Apply-Home-Loan')); ?>">Home Loan</a></li>
                            </ul>

                            <p><?php if(!empty(config('app.copyright'))): ?> <?php echo e(config('app.copyright')); ?> <?php else: ?> Copyright &copy;
                                <script>
                                document.write(new Date().getFullYear());
                                </script> | India Property Clinic. All Rights Reserved. <?php endif; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="social_link social_linkfoot">
                            <a href="https://www.facebook.com/indiapropertyclinic"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-google"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d7623feab6f1000123c84da&product=inline-share-buttons' async='async'></script>

</footer>


<?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/layouts/frontLayout/footer_design.blade.php ENDPATH**/ ?>