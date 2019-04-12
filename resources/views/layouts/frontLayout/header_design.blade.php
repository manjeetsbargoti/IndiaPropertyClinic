<?php 
use App\Http\Controllers\Controller;
$mainnavservice = Controller::mainNav();

?>

<div id="page">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="user_contact">
                            <ul>
                                <li><a href="tel:0123456780"><i class="fas fa-phone"></i> 012-345-6789</a></li>
                                <li><a href="mailto: info@indiapropertyclinic.com"><i class="fas fa-envelope"></i> info@indiapropertyclinic.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="header_topr">
                            <ul>
                                <li><a href="{{ url('/Apply-Home-Loan') }}">Home Loan</a></li>
                                <li>
                                    <div class="select_curency">
                                        <select>
                                            <option>INR</option>
                                            <option>DOLOR</option>
                                            <option>CHINESE</option>
                                        </select>
                                    </div>
                                </li>
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
					<li><a href="#" >Home</a></li>
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
                        <div class="moblogo"><a href="#"><img src="/images/frontend_images/images/logo.svg"></a></li></div>
                        <div class="mobuser_profile">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @guest    
                                    My Account
                                @else
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                @endguest
                                </button>
                                <div class="dropdown-menu profilemenu" aria-labelledby="dropdownMenuButton">
                                    <ul>
                                        <!-- Authentication Links -->
                                        @guest
                                            <li><a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a></li>
                                        @else
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
        <a class="navbar-brand" href="/"><img src="/images/frontend_images/images/logo.svg"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            @foreach($mainnavservice as $mainnav)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/view-properties/for='.$mainnav->id) }}">{{ $mainnav->service_name }} <span class="sr-only">(current)</span></a>
            </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="#">Tools & Advice</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Packages</a>
            </li>
            </ul>
            <div class="user_profile">
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @guest    
                        My Account
                    @else
                    {{ Auth::user()->first_name }} <span class="caret"></span>
                    @endguest
                    </button>
                    <div class="dropdown-menu profilemenu" aria-labelledby="dropdownMenuButton">
                        <ul>
                            <!-- Authentication Links -->
                            @guest
                                <li><a href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a></li>
                            @else
                                <li><a href="{{ url('/My-Account') }}"><i class="fas fa-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="fas fa-home"></i> My Properties List</a></li>
                                <li><a href="#"><i class="fas fa-heart"></i> Favorites</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                            @endguest
                        </ul>
                    </div>
                </div>
                    
            </div>
        </div>                            
        </div>
        </nav>
        <!-- Main Menu desktop menu end -->