<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    <div class="left-top-bar">
                        <font size="3px" color="#fff">
                        01928511049 &nbsp;&nbsp;&nbsp;
                        asadullahkpi@gmail.com
                        </font>
                    </div>
                </div>

                <div class="right-top-bar flex-w h-full">
                    <ul class="social">
                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->		
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('public/frontend/images/logo/logo.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('index') }}">HOME</a>
                        </li>
                        <li class="active-menu">
                            <a href="#">SHOPS</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="shoping-cart.html">Checkout</a></li>
                                <li><a href="{{ route('carts') }}">Cart</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="">ABOUT US</a>
                        </li>
                        <li>
                            <a href="{{ route('contacts') }}">CONTACT US</a>
                        </li>
                        @if(@Auth::user()->id != NULL && @Auth::user()->usertype = 'customer')
                        <li class="active-menu">
                            <a href="">{{ Auth::user()->name }}</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('customer.dashboard') }}">My Profile</a></li>
                                <li><a href="{{ route('customer.change.password') }}">Change Password</a></li>
                                <li><a href="{{ route('customer.order.list') }}">My Order</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li><a href="{{ route('customer.login') }}">LOGIN</a></li>
                        @endif
                        
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ Cart::count() }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="{{ route('index') }}"><img src="{{ asset('public/frontend/images/logo/logo.png') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{ Cart::count() }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    <font size="3px" color="#fff">
                    01928511049 &nbsp;&nbsp;&nbsp;
                    asadullahkpi@gmail.com
                    </font>
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <ul class="social">
                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li class="youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li>
                <a href="">SHOPS</a>
                <ul class="sub-menu-m">
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="">Checkout</a></li>
                    <li><a href="{{ route('carts') }}">Cart</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>
            <li>
                <a href="">ABOUT US</a>
            </li>
            <li>
                <a href="{{ route('contacts') }}">CONTACT US</a>
            </li>
            @if(@Auth::user()->id != NULL && @Auth::user()->usertype = 'customer')
            <li>
                <a href="">{{ Auth::user()->name }}</a>
                <ul class="sub-menu-m">
                    <li><a href="{{ route('customer.dashboard') }}">My Profile</a></li>
                    <li><a href="{{ route('customer.change.password') }}">Change Password</a></li>
                    <li><a href="{{ route('customer.order.list') }}">My Order</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>
            @else
            <li><a href="{{ route('customer.login') }}">LOGIN</a></li>
            @endif
            
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('public/frontend/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>