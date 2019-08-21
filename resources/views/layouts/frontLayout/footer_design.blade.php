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
</style>

<footer>
    <a href="{{ url('/list-property') }}" class="list-property-float">
       <span>List Your Property</span>
    </a>
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
                <li><a href="{{ url('/properties/2/buy-properties') }}">Buy</a></li>
                <li><a href="{{ url('/properties/3/rent-properties') }}">Rent</a></li>
                <li><a href="{{ url('/properties/4/sell-properties') }}">Sell</a></li>
                <li><a href="{{ url('/country/IN/properties') }}">Properties in India</a></li>
                <li><a href="{{ url('/Apply-Home-Loan') }}">Home Loan</a></li>
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
                                    <h5>{{ config('app.name') }}</h5>
                                    <p>{{ config('app.address') }}</p>
                                    <p>{{ config('app.phone') }}</p>
                                    <p><a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                                    <p><a href="#">https://indiapropertyclinic.com</a></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="footer_box">
                                    <h5>OTHER SERVICES</h5>
                                    <div class="oter_ser">
                                        @foreach(\App\OtherServices::where('parent_id', 0)->take(5)->get() as $oths)
                                        <a href="{{ url('/services/'.$oths->url) }}">{{ $oths->service_name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="footer_box">
                                    <h5>LATEST LISTINGS</h5>
                                    <ul>
                                        <?php $counter=0; ?>
                                        @foreach($footerProperties as $footerproperty)
                                        <?php $counter++ ?>
                                        @if($counter <= 2) <li>
                                            <a href="{{ url('/properties/'.$footerproperty->property_url) }}">
                                                <span>
                                                    @if(!empty($footerproperty->image_name))<img
                                                        src="{{ asset('/images/backend_images/property_images/large/'.$footerproperty->image_name)}}">
                                                        @else
                                                        <img
                                                        src="{{ asset('/images/backend_images/property_images/large/default.jpg')}}">
                                                        @endif
                                                </span>
                                                <h6>
                                                    @if(!empty($footerproperty->city_name))
                                                    <span>{{ $footerproperty->city_name }}, {{ $footerproperty->country }}</span>
                                                    @endif
                                                    
                                                </h6>
                                                @if($footerproperty->parea)<p>{{ $footerproperty->parea }} Square Ft</p>@endif
                                                <h5>@foreach(\App\Country::where('iso2', $footerproperty->country)->get() as $curen) {{ $curen->currency }} @endforeach {{ $footerproperty->property_price }}</h5>
                                            </a>
                                            </li>
                                            @endif
                                            @endforeach

                                            <a href="{{ url('/properties') }}">View All...</a>
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
                                <p>{{ config('app.address') }}</p>
                                <p>{{ config('app.phone') }}</p>
                                <p><a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
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

                                    <@foreach(\App\OtherServices::where('parent_id', 0)->take(5)->get() as $oths)
                                        <a href="{{ url('/services/'.$oths->url) }}">{{ $oths->service_name }}</a>
                                        @endforeach

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
                                <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ url('/terms-condition') }}">Terms of Use</a></li>
                                <li><a href="{{ url('/Apply-Home-Loan') }}">Home Loan</a></li>
                            </ul>

                            <p>@if(!empty(config('app.copyright'))) {{ config('app.copyright') }} @else Copyright &copy;
                                <script>
                                document.write(new Date().getFullYear());
                                </script> | India Property Clinic. All Rights Reserved. @endif</p>
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
    
    

</footer>


<script>
//   window.fbAsyncInit = function() {
//     FB.init({
//       appId      : '2936450433093095',
//       cookie     : true,
//       xfbml      : true,
//       version    : 'v4.0'
//     });
      
//     FB.AppEvents.logPageView();   
      
//   };

//   (function(d, s, id){
//      var js, fjs = d.getElementsByTagName(s)[0];
//      if (d.getElementById(id)) {return;}
//      js = d.createElement(s); js.id = id;
//      js.src = "https://connect.facebook.net/en_US/sdk.js";
//      fjs.parentNode.insertBefore(js, fjs);
//    }(document, 'script', 'facebook-jssdk'));
   
//     FB.getLoginStatus(function(response) {
//         if (response.status === 'connected') {
//             console.log(response.authResponse.accessToken);
//         }
//     });
</script>