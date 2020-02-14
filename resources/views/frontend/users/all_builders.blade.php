@extends('layouts.frontLayout.frontend_design2')
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
	                            <form method="post" action="{{ url('/country/builders/search') }}">
	                            	{{ csrf_field() }}
		                            <div class="shortby_inn">
			                            <h6>Country</h6>
			                            <select name="country" id="country" class="productDetail" id="sort">
			                                <option disabled selected>  --  Select Country  --  </option>
			                                @foreach($country as $c)
			                                	<option value="{{ $c->iso2 }}">{{ $c->name }}</option>
			                                @endforeach
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
			                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
			                    <li class="breadcrumb-item">Builders in {{ $location }}</li>
			                </ol>
		                </nav>
		                <p><span>{{ $count }} Builders </span> </p>
		            </div>
	                
		            <div class="row">
		            	@if($count == 0)
		            		<div class="col-sm-12">
		            			<p style="text-align:center; padding-top: 2em;"><img src="{{ url('/images/no-result.png') }}"></p>
		            		</div>
                    		<div class="col-sm-12">
                    		<h5 style="text-align: center;">Oh Snap! Zero Results found for your search.</h5>
                    	</div>
                		@endif
			            @foreach($data as $d)
			            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3"  title="{{ $d->first_name }} {{ $d->last_name }}">
			                    <a href="{{ url('/profile/'.$d->id.'/user') }}"><div class="product_box">
			                        <div class="product_img">
			                            <div class="owl-carousel product-slide owl-theme">
			                                <div class="item"><img class="img-fluid" style="max-height: 161px" src="{{ asset('/images/user.png') }}"></div>
			                            </div>
			                            <div class="bottom_strip">
		                                    
		                                    
		                                    <span class="tagbtn rent">{{ $d->usertype }}</span>
		                                </div>   
			                        </div>
			                        <div class="product_text">
			                           	<div class="protxt_inn">
			                                <h6 style="width: 100%;" title="{{ $d->first_name }} {{ $d->last_name }}">{{ $d->first_name }}</h6>
			                                <p>{{ $d->city }}, {{ $d->country }}</p>
			                                <div class="price_sec">
			                                    <ul>
			                                        <li>
			                                            <a href="{{ url('/profile/'.$d->id.'/user') }}" class="btn_fullinfo">Info</a>
			                                        </li>
			                                    </ul>
			                                </div>
			                            </div>
			                        </div>
			                    </div></a>
			            </div>
			            @endforeach
		               
		            </div>
		            <div class="product_loadding">
                    {!! $data->render() !!}
                </div>
		        </div>
	        </div>
	    </div>
	</div>
</div>

@endsection