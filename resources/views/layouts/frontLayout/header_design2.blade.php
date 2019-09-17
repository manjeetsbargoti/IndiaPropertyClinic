<?php 
use App\Http\Controllers\Controller;
$mainnavservice = Controller::mainNav();

$continent = Controller::continents();
$country = Controller::countries();

?>

<style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
        /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }
</style>

<div id="page">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="user_contact">
                        <ul>
                            <li><a href="tel:{{ config('app.phone') }}"><i class="fas fa-phone"></i> {{ config('app.phone') }}</a></li>
                            <li><a href="mailto:{{ config('app.email') }}"><i class="fas fa-envelope"></i>
                            {{ config('app.email') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="header_topr">
                        <ul>
                            <li><?php $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']); echo $arr_ip->country; ?></li>
                            <li><a href="{{ url('/Apply-Home-Loan') }}">Home Loan</a></li>
                            <li><?php $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']); echo $arr_ip->currency; ?></li>
                            <li>
                                <div class="social_link">
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                    <a href="#"><i class="fab fa-google"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu start -->
    <nav id="menu">
        <ul>
            <li><a href="#">Home</a></li>
            <li><span>About us</span>
                <ul>
                    <li><a href="#about/history">History</a></li>
                    <li><span>The team</span>
                        <ul>
                            <li><a href="#about/team/management">Management</a></li>
                            <li><a href="#about/team/sales">Sales</a></li>
                            <li><a href="#about/team/development">Development</a></li>
                        </ul>
                    </li>
                    <li><a href="#about/address">Our address</a></li>
                </ul>
            </li>
            <li><a href="#contact">Contact</a></li>

            <li class="Divider">Other demos</li>
            <li><a href="advanced.html">Advanced demo</a></li>
            <li><a href="onepage.html">One page demo</a></li>
        </ul>
    </nav>

    <nav id="mobileHeader" class="navbar-expand-lg navbar-light mobile_nav followMeBar">
        <div class="container">
            <div class="col-lg-12">
                <div class="mobile_menu">
                    <div class="burger_menu"><a href="#menu"><i class="fas fa-bars barmenu"></i></a></div>
                    <div class="moblogo"><a href="{{ url('/') }}"><img
                                src="/images/frontend_images/images/logo.svg"></a></li>
                    </div>
                    <div class="mobuser_profile">
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @guest
                                <i class="fas fa-user fa-2x"></i>
                                @endguest
                            </button>
                            <div class="dropdown-menu profilemenu" aria-labelledby="dropdownMenuButton">
                                <ul>
                                    <!-- Authentication Links -->
                                    @guest
                                    <li><a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i>
                                            {{ __('Login') }}</a></li>
                                    @else
                                    <li><a><i class="fas fa-sign-in-alt"></i> {{ Auth::user()->first_name }}</a></li>
                                    <li><a href="#"><i class="fas fa-user"></i> My Profile</a></li>
                                    <li><a href="#"><i class="fas fa-home"></i> My Properties List</a></li>
                                    <li><a href="#"><i class="fas fa-heart"></i> Favorites</a></li>
                                    <li><a href="#"><i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}</a></li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Mobile menu end -->

    <!-- Main Menu desktop menu start -->
    <nav id="myHeader" class="navbar navbar-expand-lg navbar-light custom_nav followMeBar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="/images/frontend_images/images/logo.svg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="inner_search">
                <form action="{{ url('/search-result') }}" method="post">
                    {{ csrf_field() }}
                    <div class="jiosearch_outer">
                        <select name="property_cat">
                            @foreach($mainnavservice as $mainnav)
                            <option value="{{ $mainnav->id }}">{{ $mainnav->service_name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="search_text" id="search_name" class="search_location"
                            data-role="tagsinput" placeholder="Search here...">
                        <div id="searchlist"></div>
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @foreach($mainnavservice as $mainnav)
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('properties/'.$mainnav->id.'/'.$mainnav->url)) ? 'active':'' }}"
                            href="{{ url('/properties/'.$mainnav->id.'/'.$mainnav->url) }}">{{ $mainnav->service_name }}
                            <span class="sr-only">(current)</span></a>
                    </li>
                    @endforeach
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Services</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="overflow:scroll;max-height: 30em;">
                            @foreach(\App\OtherServices::where('parent_id', 0)->get() as $rservice)
                            <a class="dropdown-item" href="{{ url('/services/'.$rservice->url) }}">{{ $rservice->service_name }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <div class="user_profile">
                    <div class="dropdown">
                        @guest
                        <button class="btn btn-link"><a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i>
                                {{ __('Login') }}</a></button>
                        @else
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-user"></i></button>
                        @endguest
                        @guest
                        @else
                        <div class="dropdown-menu profilemenu" aria-labelledby="dropdownMenuButton">
                            <ul>
                                <!-- Authentication Links -->
                                
                                <li><a>{{ Auth::user()->first_name }}</a></li>
                                <li><a
                                        href="@if(Auth::user()->admin == 1) {{ url('/admin/dashboard') }}  @else {{ url('/My-Account') }} @endif"><i
                                            class="fas fa-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="fas fa-home"></i> My Properties List</a></li>
                                <li><a href="#"><i class="fas fa-heart"></i> Favorites</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="topcountries">
                    <button data-toggle="collapse" data-target="#topcon_toggle">
                        <span class="country_before">Top Countries</span>
                    </button>
                    <div id="topcon_toggle" class="collapse">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <ul class="nav flex-column" id="myTab" role="tablist">
                                        <?php $counter = 0; ?>
                                        @foreach($continent as $c)
                                        <?php $counter++; ?>
                                        <li class="nav-item">
                                            <a class="nav-link show <?= ($counter == 1) ? 'active' : ''?>"
                                                id="cont{{ $c->code }}-tab" data-toggle="tab" href="#{{ $c->code }}"
                                                role="tab" aria-controls="cont{{ $c->code }}tab"
                                                aria-selected="<?=($counter == 1) ? 'true' : ''?>"><span
                                                    class="mapicon">
                                                    <img
                                                        src="/images/frontend_images/images/{{ $c->icon_image }}"></span>{{ $c->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-9">
                                    <div class="tab-content" id="myTabContent">
                                        <?php $counter = 0; ?>
                                        @foreach($continent as $c)
                                        <?php $counter++; ?>
                                        <div class="tab-pane fade show <?= ($counter == 1) ? 'active' : ''?>"
                                            id="{{ $c->code }}" role="tabpanel"
                                            aria-labelledby="cont{{ $c->code }}-tab">
                                            <ul class="country_list">
                                                @foreach($country as $coun)
                                                @if($coun->continent == $c->code)
                                                <li>
                                                    <a href="{{ url('/country/'.$coun->iso2.'/properties?country='.$coun->iso2) }}"
                                                        style="margin: 0.2em 0em;"
                                                        class="btn btn-outline-dark">{{ $coun->name }}</a>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main Menu desktop menu end -->