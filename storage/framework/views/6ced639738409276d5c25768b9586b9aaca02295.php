<?php $__env->startSection('content'); ?>

<div class="smart_container">
  	<div class="latest_product">
    	<div class="container">
	        <div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
	                <div class="left_sidebar">
	                    <div class="filter">
	                        <div class="shortby">
	                            <h4>Short By</h4>
	                            <div class="shortby_inn">
		                            <h6>Relevance</h6>
		                            <select name="filter" class="productDetail" id="sort">
		                                <option disabled selected>Sort By</option>
		                                <option value="1">Most Recent</option>
		                                <option value="asc">Price - Low to High</option>
		                                <option value="desc">Price - High to Low</option>
		                            </select>
		                        </div>
	                        </div>

	                        <div class="shortby">
	                            <h4>Search By Location</h4>
	                            <form method="post" action="<?php echo e(url('/country/builders/search')); ?>">
	                            	<?php echo e(csrf_field()); ?>

		                            <div class="shortby_inn">
			                            <h6>Country</h6>
			                            <select name="country" id="country" class="productDetail" id="sort">
			                                <option disabled selected>  --  Select Country  --  </option>
			                                <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                                	<option value="<?php echo e($c->iso2); ?>"><?php echo e($c->name); ?></option>
			                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                            </select>
			                        </div>

			                        <div class="shortby_inn">
			                            <h6>State</h6>
			                            <select name="state" id="state" class="productDetail" id="sort">
			                                <option disabled selected>  -- Select State  --  </option>
			                            </select>
			                        </div>

			                        <div class="shortby_inn">
			                            <h6>City</h6>
			                            <select name="city" id="city" class="productDetail" id="sort">
			                                <option disabled selected>  --  Select City  --  </option>
			                            </select>
			                        </div>

			                        <div class="shortby_inn">
			                            <button type="submit" class="btn pull-right" style="background: #F15A27;color: #fff; border: none;height: 31px;border-radius: 3px;display: block;">Filter</button>
			                        </div>
			                    </form>
	                        </div>
	                        
	                    </div>
	                </div>
	            </div>

				<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-9" id="property_cont">
		            <div class="header_breadcrumb" id="breadcrumb_view">
		                <nav aria-label="breadcrumb">
			                <ol class="breadcrumb">
			                    <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
			                    <li class="breadcrumb-item">Dealers in <?php echo e('Country'); ?></li>
			                </ol>
		                </nav>
		                <p><span>1234 Dealers </span> </p>
		            </div>
	                
		            <div class="row">
		                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"  title="<?php echo e($d->first_name); ?> <?php echo e($d->last_name); ?>">
		                    <a href="<?php echo e(url('/profile/'.$d->id.'/user')); ?>"><div class="product_box">
		                        <div class="product_img">
		                            <div class="owl-carousel product-slide owl-theme">
		                                <div class="item"><img class="img-fluid" style="max-height: 161px" src="<?php echo e(asset('/images/user.png')); ?>"></div>
		                            </div>
		                            <div class="bottom_strip">
	                                    
	                                    
	                                    <span class="tagbtn rent"><?php echo e($d->usertype); ?></span>
	                                </div>   
		                        </div>
		                        <div class="product_text">
		                           	<div class="protxt_inn">
		                                <h6 style="width: 100%;" title="<?php echo e($d->first_name); ?> <?php echo e($d->last_name); ?>"><?php echo e($d->first_name); ?></h6>
		                                <p><?php echo e($d->city); ?>, <?php echo e($d->country); ?></p>
		                                <div class="price_sec">
		                                    <ul>
		                                        <li>
		                                            <a href="<?php echo e(url('/profile/'.$d->id.'/user')); ?>" class="btn_fullinfo">Info</a>
		                                        </li>
		                                    </ul>
		                                </div>
		                            </div>
		                        </div>
		                    </div></a>
		                </div>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		            </div>
		            <div class="product_loadding">
                    <?php echo $data->render(); ?>

                </div>
		        </div>
	        </div>
	    </div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GITHUB\IndiaPropertyClinic\resources\views/frontend/users/all_users.blade.php ENDPATH**/ ?>