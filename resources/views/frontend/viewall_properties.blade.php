@extends('layouts.frontLayout.frontend_design')
@section('content')

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
                            <select>
                                <option>Latest</option>
                                <option>Old</option>
                                <option>Latest</option>
                                <option>Latest</option>
                                <option>Latest</option>
                            </select>
                        </div>
                        </div>
                        <h4 class="filter_title">FILTER</h4>
                        <div class="filter_box">
                            <ul>
                                <li><h6>Bhk<a href="#">Clear</a></h6></li>
                                <li>
                                    <div id="ck-button">
                                        <label>
                                            <input type="checkbox" value="1"><span>1 Bhk</span>
                                        </label>
                                    </div>
                                    <div id="ck-button">
                                        <label>
                                            <input type="checkbox" value="2"><span>2 Bhk</span>
                                        </label>
                                    </div>
                                    <div id="ck-button">
                                        <label>
                                            <input type="checkbox" value="3"><span>3 Bhk</span>
                                        </label>
                                    </div>
                                </li>
                                <li><h6>BUDGET<a href="#">Clear</a></h6></li>
                                <li>
                                    <form>
                                        <div class="range_mintomax">
                                            <input type="range" name="ageInputName" id="ageInputId" value="200000" min="1" max="10000000" oninput="ageOutputId.value = ageInputId.value">
                                            <span>₹ </span><output class="text" name="ageOutputName" id="ageOutputId">200000</output>
                                        </div>
                                    </form>
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
                                                    Locality   
                                                </button>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <form>
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Default checkbox
                                                        </label>
                                                        </div>

                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Default checkbox
                                                        </label>
                                                        </div>

                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                                        <label class="form-check-label" for="defaultCheck3">
                                                            Default checkbox
                                                        </label>
                                                        </div>

                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                                        <label class="form-check-label" for="defaultCheck4">
                                                            Default checkbox
                                                        </label>
                                                        </div>

                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                                        
                                                        
                                            <div class="more_filteritem">          
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Posted By 
                                                </button>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        Option 2
                                                    </div>
                                                </div>
                                            </div>    
      
                                            <div class="more_filteritem"> 
                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Furnishing
                                                </button>
                                            
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    Option 3
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-9">
                <div class="header_breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                      <li class="breadcrumb-item">All Properties</li>
                    </ol>
                  </nav>
                  <p><span><?php echo $contRow; ?> Properties </span> </p>
                </div>

                  <div class="row posts endless-pagination" data-next-page="{{ $posts->nextPageUrl() }}">
                    @foreach($posts as $property)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4">
                       
                        <div class="product_box">
                            <div class="product_img">
                                <div class="owl-carousel product-slide owl-theme">
                                    @foreach($propertyImages as $carousal)
                                    @if($property->id==$carousal->property_id)
                                    <div class="item"><img src="{{ asset('/images/backend_images/property_images/large/'.$carousal->image_name)}}"></div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="rateing">
                                    <i class="staricon"><img src="/images/frontend_images/images/star.svg"></i><span class="autorate">3.5</span> / 5
                                </div>
                                <div class="bottom_strip">
                                    <h6><i class="fas fa-map-marker-alt"></i> {{ $property->city_name }}, {{ $property->country_name }}</h6>
                                    <p>{{ $property->parea }} Square Ft</p>
                                    <span class="tagbtn rent">{{ $property->service_name }}</span>
                                </div>  
                            </div>
                            <div class="product_text">
                                <div class="protxt_top">
                                    <ul>
                                        <li><i><img src="/images/frontend_images/images/room.svg"></i><p><span>{{ $property->rooms }}</span>Rooms</p></li>
                                        <li><i><img src="/images/frontend_images/images/bedroom.svg"></i><p><span>{{ $property->bedrooms }}</span>Bedrooms</p></li>
                                        <li><i><img src="/images/frontend_images/images/bathroom.svg"></i><p><span>{{ $property->bathrooms }}</span>Bathroom</p></li>
                                    </ul>
                                </div>
                                <div class="protxt_inn">
                                    <h6>{{ $property->property_name }}</h6>
                                    <p>{{ strip_tags($property->description) }}</p>
                                    <div class="price_sec">
                                        <ul>
                                            <li><h5><span>INR</span> {{ $property->property_price }}</h5></li>
                                            <li><a href="/properties/{{ $property->property_url }}" class="btn_fullinfo">Full Info</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="product_loadding">
                    {!! $posts->render() !!}
                    <!-- <img src="/images/frontend_images/images/loadder.svg"> -->
                </div>

            </div>
        </div>
        
        
    </div>
</div>


</div>

@stop