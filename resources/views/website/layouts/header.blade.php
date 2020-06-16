<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="#">
    <meta name="description" content="#">
    {{-- <title>Foodvia | Food Delivery</title> --}}
    <title>@yield('title')</title>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
    <link rel="apple-touch-icon-precomposed" href="#">
    <link rel="shortcut icon" href="#">
    <!-- Bootstrap -->
    <link href={{ asset("website/assets/css/bootstrap.min.css") }} rel="stylesheet">
    <!-- Fontawesome -->
    <link href={{ asset("website/assets/css/font-awesome.css") }} rel="stylesheet">
    <!-- Flaticons -->
    <link href={{ asset("website/assets/css/font/flaticon.css") }} rel="stylesheet">
    <!-- Swiper Slider -->
    <link href={{ asset("website/assets/css/swiper.min.css") }} rel="stylesheet">
    <!-- Range Slider -->
    <link href={{ asset("website/assets/css/ion.rangeSlider.min.css") }} rel="stylesheet">
    <!-- magnific popup -->
    <link href={{ asset("website/assets/css/magnific-popup.css") }} rel="stylesheet">
    <!-- Nice Select -->
    <link href={{ asset("website/assets/css/nice-select.css") }} rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href={{ asset("website/assets/css/style.css") }} rel="stylesheet">
    <!-- Custom Responsive -->
    <link href={{ asset("website/assets/css/responsive.css") }} rel="stylesheet">
	<!-- Color Change -->
    {{-- <link rel="stylesheet" class="color-changing" href={{ asset("website/assets/css/color4.css") }}> --}}
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap" rel="stylesheet">
    <!-- place -->
    {{-- page specific css --}}
    <link rel="stylesheet" href="{{ asset('jquery-toast-plugin-master/src/jquery.toast.css') }}">
    
    @yield('css')
</head>

<body>
    
    <!-- Navigation -->
    <div class="header">
        <header class="full-width">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mainNavCol">
                        <!-- logo -->
                        <div class="logo mainNavCol">
                            <a href="{{ route('home') }}">
                                <img src={{ asset("website/assets/img/hunger_wings.png") }} class="img-fluid" alt="Logo">
                            </a>
                        </div>
                        <!-- logo -->
                        <div class="main-search mainNavCol">
                            <form action="{{url('restaurants')}}" class="main-search search-form full-width">
                                <div class="row">
                                    <!-- location picker -->
                                    <div class="col-lg-6 col-md-5">
                                        <a href="#" class="delivery-add p-relative"> <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                            <span class="address">Find Food Near Me</span>
                                        </a>
                                    {{-- <form a > --}}
                                        <div class="location-picker">
                                            <input type="text" id="pac-input " class="form-control" placeholder="Add new address">
                                                <div id="map"></div>
                                                <input type="hidden" id="latitude_cur" name="latitude" id="lat">
                                                <input type="hidden" id="longitude_cur" name="longitude" id="lng">
                                                <input type="hidden" name="search_loc" id="location">
                                                <button type="submit" value="submit" class="btn btn-warning">Find</button>
                                            </div>
                                    {{-- </form> --}}
                                </form>
                                        
                                    </div>
                                    <!-- location picker -->
                                    <!-- search -->
                                    <div class="col-lg-6 col-md-7">
                                        <div class="search-box padding-10">
                                            <input type="text" class="form-control" placeholder="Pizza, Burger, Chinese">
                                        </div>
                                    </div>
                                    <!-- search -->
                                </div>
                        </div>
                        <div class="right-side fw-700 mainNavCol">
                            <div class="gem-points">
                                <a href="#"> <i class="fas fa-concierge-bell"></i>
                                    <span>Order Now</span>
                                </a>
                            </div>
                            <div class="catring parent-megamenu">
                                <a href="#"> <span>Menu<i class="fas fa-caret-down"></i></span>
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <div class="ex-collection-box h-100">
                                                        <a href="#">
                                                            <img src={{ asset("website/assets/img/nav-1.jpg") }} class="img-fluid full-width h-100" alt="image">
                                                        </a>
                                                        <div class="category-type overlay padding-15"> <a href="restaurant.html" class="category-btn">Top rated</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="#" class="text-light-black">Add Restaurants</a></h6>
                                                                </div>
                                                                <ul>
                                                                    <li class="active"><a href="{{ route('home') }}" class="text-light-white fw-500">Restaurants 1</a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="#" class="text-light-black">About Us</a></h6>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="{{ route('about') }}" class="text-light-white fw-500">About</a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="#" class="text-light-black">Restaurants</a></h6>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="{{ route('add_restaurant') }}" class="text-light-white fw-500">Restaurant</a>
                                                                    </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="#" class="text-light-black">Account</a></h6>
                                                                </div>
                                                                <ul>
                                                                    @if(Auth::user())

                                                                    <li><a href="{{ route('web_checkout') }}" class="text-light-white fw-500">Checkout</a>
                                                                    </li>
                                                                    <li><a href="{{ route('order_details') }}" class="text-light-white fw-500">Order Details</a>
                                                                    </li>
                                                                    @else

                                                                    <li><a href="{{route('web_login')}}" class="text-light-white fw-500">Login</a>
                                                                    </li>
                                                                    <li><a href="{{ route('web_register') }}" class="text-light-white fw-500">Sign-up</a>
                                                                    </li>
                                                                    @endif

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- mobile search -->
                            <div class="mobile-search">
                                <a href="#" data-toggle="modal" data-target="#search-box"> <i class="fas fa-search"></i>
                                </a>
                            </div>
                            <!-- mobile search -->
                            <!-- user account -->
                            @if(Auth::user())
                            <div class="user-details p-relative">
                                <a href="#" class="text-light-white fw-500">
                                    <img src={{ asset("website/assets/img/user-1.png") }} class="rounded-circle" alt="userimg"> <span>Hi, Kate</span>
                                </a>
                                <div class="user-dropdown">
                                    <ul>
                                        <li>
                                            <a href="order-details.html">
                                                <div class="icon"><i class="flaticon-rewind"></i>
                                                </div> <span class="details">Past Orders</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="order-details.html">
                                                <div class="icon"><i class="flaticon-takeaway"></i>
                                                </div> <span class="details">Upcoming Orders</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-breadbox"></i>
                                                </div> <span class="details">Saved</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-gift"></i>
                                                </div> <span class="details">Gift cards</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-refer"></i>
                                                </div> <span class="details">Refer a friend</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-diamond"></i>
                                                </div> <span class="details">Perks</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-user"></i>
                                                </div> <span class="details">Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="icon"><i class="flaticon-board-games-with-roles"></i>
                                                </div> <span class="details">Help</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="user-footer"> <span class="text-light-black">Not Jhon?&nbsp <a herf="#" class="btn btn-outline-danger" id="signOut"><span>Sign out</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                                &nbsp<a href="{{route('web_login')}}"> <i class="fas fa-user-plus"></i>
                                    <span>Login</span>
                                </a>
                            @endif



                            <!-- mobile search -->
                            <!-- user notification -->
                            <div class="cart-btn notification-btn">
                                <a href="#" class="text-light-green fw-700"> <i class="fas fa-bell"></i>
                                    <span class="user-alert-notification"></span>
                                </a>
                                <div class="notification-dropdown">
                                    <div class="product-detail">
                                        <a href="#">
                                            <div class="img-box">
                                                <img src={{ asset("website/assets/img/shop-1.png") }} class="rounded" alt="image">
                                            </div>
                                            <div class="product-about">
                                                <p class="text-light-black">Lil Johnny’s</p>
                                                <p class="text-light-white">Spicy Maxican Grill</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="rating-box">
                                        <p class="text-light-black">How was your last order ?.</p> <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                        <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                        <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                        <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                        <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                        <cite class="text-light-white">Ordered 2 days ago</cite>
                                    </div>
                                </div>
                            </div>
                            <!-- user notification -->
                            <!-- user cart -->
                            <div class="cart-btn cart-dropdown">
                                <a href="#" class="text-light-green fw-700"> <i class="fas fa-shopping-bag"></i>
                                    <span class="user-alert-cart">3</span>
                                </a>
                                <div class="cart-detail-box">
                                    <div class="card">
                                        <div class="card-header padding-15">Your Order</div>
                                        <div class="card-body no-padding" id='addToHeaderCart'>
                                            {{-- <div class="cat-product-box">
                                                <div class="cat-product">
                                                    <div class="cat-name">
                                                        <a href="#">
                                                            <p class="text-light-green"><span class="text-dark-white">1</span> Chilli Chicken</p> <span class="text-light-white">small, chilli chicken</span>
                                                        </a>
                                                    </div>
                                                    <div class="delete-btn">
                                                        <a href="#" class="text-dark-white"> <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                    <div class="price"> <a href="#" class="text-dark-white fw-500">
                              $2.25
                            </a>
                                                    </div>
                                                </div>
                                            </div> --}}
                                           
{{--                                            <div class="cat-product-box">--}}
{{--                                                <div class="cat-product">--}}
{{--                                                    <div class="cat-name">--}}
{{--                                                        <a href="#">--}}
{{--                                                            <p class="text-light-green"><span class="text-dark-white">1</span> Tortia Chicken</p> <span class="text-light-white">small, chilli chicken</span>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="delete-btn">--}}
{{--                                                        <a href="#" class="text-dark-white"> <i class="far fa-trash-alt"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="price"> <a href="#" class="text-dark-white fw-500">--}}
{{--                                                        $2.25--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="item-total">
                                                <div class="total-price border-0"> <span class="text-dark-white fw-700">Items subtotal:</span>
                                                    <span class="text-dark-white fw-700">$9.99</span>
                                                </div>
                                                <div class="empty-bag padding-15"> <a href="#">Empty bag</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer padding-15"> <a href="checkout.html" class="btn-first green-btn text-custom-white full-width fw-500">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- user cart -->
                        </div>
                    </div>
                    <div class="col-sm-12 mobile-search">
                        <div class="mobile-address">
                            <a href="#" class="delivery-add" data-toggle="modal" data-target="#address-box"> <span class="address">Food Near me</span>
                            </a>
                        </div>
                        <div class="sorting-addressbox"> <span class="full-address text-light-green">location</span>
                            <div class="btns">
                                <div class="filter-btn">
                                    <button type="button"><i class="fas fa-sliders-h text-light-green fs-18"></i>
                                    </button> <span class="text-light-green">Sort</span>
                                </div>
                                <div class="filter-btn">
                                    <button type="button"><i class="fas fa-filter text-light-green fs-18"></i>
                                    </button> <span class="text-light-green">Filter</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
{{--                </div>--}}
{{--            </div>--}}
        </header>
    </div>
    <div class="main-sec"></div>
    
   
        

    @yield('main_content')
    
    
