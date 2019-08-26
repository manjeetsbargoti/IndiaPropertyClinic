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
                        <h4 class="filter_title">FILTER</h4>
                        <div class="filter_box">
                            <ul>
                                <li><h6>Category</h6></li>
                                <li>
                                    <div id="ck-button">
                                        <label>
                                            <input type="checkbox" class="productDetail service" value="3"><span>Rent</span>
                                        </label>
                                    </div>
                                    <div id="ck-button">
                                        <label>
                                            <input type="checkbox" class="productDetail service" value="4"><span>Sell</span>
                                        </label>
                                    </div>
                                </li>
                                <li><h6>BUDGET<a href="#">Clear</a></h6></li>
                                <li>
                                    <div class="range_new">
                                        <div id="slider-range"></div>
                                        <input type="hidden" name="min-value" class="min-price" value="">
                                        <input type="hidden" name="max-value" class="max-price" value="">
                                        <strong>Min:</strong> <span id="slider-range-value1"></span>
                                        <strong>Max:</strong> <span id="slider-range-value2"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="filter_box more_filtersec">
                            <ul>
                                <li><h4>More Filter</h4></li>
                                <li>
                                    <div class="accordion" id="accordionExample"> 
                                    <div class="more_filteritem">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Rooms   
                                            </button>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="bedSection">
                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail room" value="1"> 1 Room</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail room" value="2"> 2 Rooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail room" value="3"> 3 Rooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail room" value="4"> 4 Rooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail room" value="5"> 5 Rooms</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="more_filteritem">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                Bedrooms   
                                            </button>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="bedSection">
                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bed" value="1"> 1 Bedroom</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bed" value="2"> 2 Bedrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bed" value="3"> 3 Bedrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bed" value="4"> 4 Bedrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bed" value="5"> 5 Bedrooms</label>
                                                    </div>
                                            
                                                </div>
                                            </div>
                                        </div>          
                                        <div class="more_filteritem">          
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Bathrooms
                                            </button>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                <div class="bedSection">
                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bathroom" value="1"> 1 bathrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bathroom" value="2"> 2 bathrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bathroom" value="3"> 3 bathrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bathroom" value="4"> 4 bathrooms</label>
                                                    </div>
                                                                    <div class="form-check">
                                                    <label><input type="checkbox" class="productDetail bathroom" value="5"> 5 bathrooms</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-9" id="property_cont">
                <div class="header_breadcrumb" id="breadcrumb_view">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                      <li class="breadcrumb-item">All Properties</li>
                    </ol>
                  </nav>
                  <p><span><?php echo $contRow; ?> Properties </span> </p>
                </div>

                  <div class="row posts endless-pagination" data-next-page="<?php echo e($posts->nextPageUrl()); ?>" >
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                       
                        <div class="product_box">
                            <div class="product_img">
                                <div class="owl-carousel product-slide owl-theme">
                                    <?php $__currentLoopData = \App\PropertyImages::where('property_id', $property->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item"><img src="<?php echo e(asset('/images/backend_images/property_images/large/'.$pimage->image_name)); ?>"></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="bottom_strip">
                                    <h6><i class="fas fa-map-marker-alt"></i> 
                                    <?php if(!empty($property->city_name)): ?>
                                        <span><?php echo e($property->city_name); ?>, </span>
                                    <?php endif; ?> 
                                    <?php if(!empty($property->country_name)): ?>
                                        <span><?php echo e($property->country_name); ?></span>
                                    <?php endif; ?>
                                    </h6>
                                    <p><?php if($property->parea): ?><?php echo e($property->parea); ?> Square Ft <?php endif; ?></p>
                                    <span class="tagbtn rent"><?php echo e($property->service_name); ?></span>
                                </div>  
                            </div>
                            <div class="product_text">
                                <div class="protxt_top">
                                    <ul>
                                        <li><i><img src="/images/frontend_images/images/room.svg"></i><p><span><?php echo e($property->rooms); ?></span>Rooms</p></li>
                                        <li><i><img src="/images/frontend_images/images/bedroom.svg"></i><p><span><?php echo e($property->bedrooms); ?></span>Bedrooms</p></li>
                                        <li><i><img src="/images/frontend_images/images/bathroom.svg"></i><p><span><?php echo e($property->bathrooms); ?></span>Bathroom</p></li>
                                    </ul>
                                </div>
                                <div class="protxt_inn">
                                    <h6><?php echo e($property->property_name); ?></h6>
                                    <p><?php echo e(strip_tags($property->description)); ?></p>
                                    <div class="price_sec">
                                        <ul>
                                            <li>
                                            <?php if(!empty($property->property_price)): ?>
                                                <h5><span><?php if(!empty($property->property_price)): ?><?php echo e($property->currency); ?><?php endif; ?></span> <?php echo e($property->property_price); ?></h5>
                                            <?php else: ?>
                                                <a href="/properties/<?php echo e($property->property_url); ?>" class="btn_fullinfo">Get Price</a>
                                            <?php endif; ?>
                                            </li>
                                            <li><a href="/properties/<?php echo e($property->property_url); ?>" class="btn_fullinfo">Full Info</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="product_loadding">
                    <?php echo $posts->render(); ?>

                    <!-- <img src="/images/frontend_images/images/loadder.svg"> -->
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script>  
$(window).on('hashchange', function() {
      if (window.location.hash) {
          var page = window.location.hash.replace('#', '');
          if (page == Number.NaN || page <= 0) {
              return false;
          } else {
              filterSearch(page);
          }
      }
  });

  $(document).ready(function() {
      $(document).on('click', '.pagination a', function (e) {
          filterSearch($(this).attr('href').split('page=')[1]);
          e.preventDefault();
      });
  });
    $(document).ready(function(){
        $('.productDetail').click(function(){
            filterSearch();
        });	
    });
    function filterSearch(page) {
        var id = $('#sort').val();
        var service = getFilterData('service');
        var minPrice = $('min-Price').val();
        var maxPrice = $('max-Price').val();
        var bed = getFilterData('bed');
        var bathroom = getFilterData('bathroom');
        var room = getFilterData('room');
    $.ajax({
    url:"properties_filter",
    dataType: "html",		
    data:{id:id, page:page, service:service, minPrice:minPrice, maxPrice:maxPrice, bed:bed, bathroom:bathroom, room:room},
    success:function(data){
       if(data != '') 
        {
          $('#breadcrumb_view').remove();
          $('.product_loadding').remove();
          $('#property_cont').html(data);
          location.hash = page;
          $('.product-slide').owlCarousel({
            items:1,
            loop:true,
            margin:0,
            autoplay:true,
            nav:true,
            dots:false,
            lazyLoad: true
        });
        
        }
        else
        {
          $('.product_loadding').html("No Data");
        }
      }
    });
    }
    function getFilterData(className) {
    var filter = [];
    $('.'+className+':checked').each(function(){
        filter.push($(this).val());
        });
    return filter;
    }
</script>

<style>
    .bedSection {
        height: 100px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .page-link{color:#171747;}
    .page-item.active .page-link{
        background-color:#171747;
        border-color: #171747;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontLayout.frontend_design2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GIT_Code\IndiaPropertyClinic\resources\views/frontend/viewall_properties.blade.php ENDPATH**/ ?>