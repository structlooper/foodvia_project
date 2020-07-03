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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="javascript:void(0)">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="javascript:void(0)">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="javascript:void(0)">
    <link rel="apple-touch-icon-precomposed" href="javascript:void(0)">
    <link rel="shortcut icon" href="javascript:void(0)">
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

    <script src={{ asset("website/assets/js/jquery.min.js") }}></script>


    @yield('css')
</head>

<body>
    
    <!-- Navigation -->
    <div class="header" id="urlfinder" url = {{ url('/') }}>
        <header class="full-width">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mainNavCol">
                        <!-- logo -->
                        <div class="logo mainNavCol">
                            <a href="{{ route('home') }}">
                                <img src={{ asset("website/assets/img/hunger_wings1.png") }} class="img-fluid" alt="Logo">
                            </a>
                        </div>
                        <!-- logo -->
                        <div class="main-search mainNavCol">
                                <div class="row">
                                    <!-- location picker -->
                                    <div class="col-lg-6 col-md-5">
                                        <div  class="main-search search-form full-width">
                                                <a href="javascript:void(0);" class="delivery-add p-relative" > <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                                                    <span class="address" style="text-overflow: inherit;">
                                                        @if (Session::has('search_loc'))
                                                            {{ Session::get('search_loc') }}
                                                        @else
                                                        Find Food Near Me
                                                        @endif

                                                    </span>
                                                </a>

                                                <div class="location-picker" style="width: 500px;">
                                                    <input type="text" id="pac-input" class="form-control"  placeholder="Add new address" autocomplete="off">
                                                    <form action="{{url('Searchrestaurants')}}" id="searchLocation">
                                                        <div class="map"></div>
                                                        <input type="hidden"  id="lat" name="latitude" >
                                                        <input type="hidden" id="lng" name="longitude" >
                                                        <input type="hidden" name="search_loc" id="location">
                                                        <button type="button" value="submit" id='searchLocationButton' class="btn btn-warning">Find</button>
                                                    </form>
                                                    </div>


                                        </div>
                                        <script>
                                            $('#searchLocationButton').click(function(event){
                                                event.preventDefault();
                                                if($('#pac-input').val()==''){
                                                    $.toast({
                                                        heading: 'info',
                                                        text : "location is empty" ,
                                                        icon : 'info',
                                                        position: 'top-right',

                                                    })
                                                }else{
                                                    if($('#my_map_form #latitude').val()!='' && $('#my_map_form #longitude').val()!=''){
                                                        $('#searchLocation').submit();
                                                    }else{
                                                        $.toast({
                                                            heading: 'info',
                                                            text : "lat long is blank please refresh page" ,
                                                            icon : 'info',
                                                            position: 'top-right',

                                                        })
                                                    }
                                                }
                                            })
                                        </script>
                                     </div>
                                    <!-- location picker -->
                                    <!-- search -->
                                    <div class="col-lg-6 col-md-7">
                                        <div class="search-box padding-10 ml-4">
                                            <form  id="search-box-cuisine">
                                                <div class="row ">
                                                    <div class="col-sm-10 text-center">
                                                        <input type="text" class="form-control" id="search-cuisine-input" placeholder="Pizza, Burger, Chinese">
                                                    </div>
                                                        <button type="button" id="search-cuisine-button" class=" btn btn-outline-danger"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    <div class="col-sm-2">
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <script>
                                        $('#search-cuisine-button').click(function(){
                                            if ($('#search-cuisine-input').val() == ''){
                                                $.toast({
                                                    heading: 'info',
                                                    text : "please type in search box" ,
                                                    icon : 'info',
                                                    position: 'top-right',

                                                })
                                            }else{
                                                let productName = $('#search-cuisine-input').val()
                                                let base_url = $('#urlfinder').attr('url');
                                                $.ajax({
                                                    type:'GET',
                                                    url: base_url + '/api/search_product',
                                                    data: { productName:productName },


                                                    success:function(result){
                                                        console.log(result)
                                                        if (result.status === 1) {
                                                            console.log(result.message);
                                                            if (result.data.id == undefined) {
                                                                $.toast({
                                                                    heading: 'info',
                                                                    text: 'sorry,no shops find in '+productName,
                                                                    icon: 'info',
                                                                    position : 'top-right',
                                                                })
                                                            } else {
                                                                location.href = base_url + '/web/restaurant/' + result.data.id;
                                                                // $('#search-box-cuisine').submit()
                                                            }
                                                        }

                                                        else{
                                                            console.log(result.message);
                                                            $.toast({
                                                                heading: 'warning',
                                                                text: result.message,
                                                                icon: 'warning',
                                                                position : 'top-right',
                                                            })
                                                        }


                                                    },
                                                    error:function(jqXHR)
                                                    {
                                                        console.log(jqXHR)
                                                        $.toast({
                                                            heading: 'error',
                                                            text : "Can't connect with server right now" ,
                                                            icon : 'error',
                                                            position: 'top-right',

                                                        })
                                                    }

                                                })

                                            }
                                        })
                                    </script>
                                    <!-- search -->
                                </div>
                        </div>
                        <div class="right-side fw-700 mainNavCol">
                            <div class="gem-points">
                                <a href="{{ Route('all_restro') }}"> <i class="fas fa-concierge-bell"></i>
                                    <span>Order Now</span>
                                </a>
                            </div>
                            <div class="catring parent-megamenu">
                                <a href="javascript:void(0)"> <span>Menu<i class="fas fa-caret-down"></i></span>
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <div class="ex-collection-box h-100">
                                                        <a href="javascript:void(0)">
                                                            <img src="{{ asset("website/assets/img/nav-1.jpg") }}" class="img-fluid full-width h-100" alt="image">
                                                        </a>
                                                        <div class="category-type overlay padding-15"> <a href="javascript:void(0)" class="category-btn">Top rated</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-7">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="javascript:void(0)" class="text-light-black">Restaurants</a></h6>
                                                                </div>
                                                                <ul>
                                                                    <li class="active"><a href="{{ route('home') }}" class="text-light-white fw-500">Restaurants</a>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-sm-6">
                                                            <div class="menu-style">
                                                                <div class="menu-title">
                                                                    <h6 class="cat-name"><a href="javascript:void(0)" class="text-light-black">About Us</a></h6>
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
                                                                    <h6 class="cat-name"><a href="javascript:void(0)" class="text-light-black">Account</a></h6>
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
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#search-box"> <i class="fas fa-search"></i>
                                </a>
                            </div>
                            <!-- mobile search -->
                            <!-- user account -->
                            @if(Auth::user())
                            <div class="user-details p-relative">
                                <a href="javascript:void(0)" class="text-light-white fw-500">
                                    <img src={{ asset("website/assets/img/user-1.png") }} class="rounded-circle" alt="userimg"> <span>Hi, {{ Auth::user()->name }}</span>
                                </a>
                                <div class="user-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('order_details') }}">
                                                <div class="icon"><i class="flaticon-rewind"></i>
                                                </div> <span class="details">Orders</span>
                                            </a>
                                        </li>


                                        <li>
                                            <a href="javascript:void(0)" disabled="disabled">
                                                <div class="icon"><i class="flaticon-refer"></i>
                                                </div> <span class="details">Refer a friend</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('user_profile') }}">
                                                <div class="icon"><i class="flaticon-user"></i>
                                                </div> <span class="details">Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <div class="icon"><i class="flaticon-board-games-with-roles"></i>
                                                </div> <span class="details">Help</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="user-footer"> <span class="text-light-black">Not {{ Auth::user()->name }}?&nbsp </span><a href="javascript:void(0)" class="btn btn-outline-danger" id="signOut"><span>Sign out</span></a>
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
                            @if (Auth::user())

                            <div class="cart-btn notification-btn" >
                                <a href="javascript:void(0)" class="text-light-green fw-700"> <i class="fas fa-bell"></i>
                                    <span class="user-alert-notification"></span>
                                </a>
                                <div class="notification-dropdown">
                                    <div class="product-detail">
                                        <a href="javascript:void(0)">
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
                                <a href="javascript:void(0)" class="text-light-green fw-700"> <i class="fas fa-shopping-bag"></i>
                                    <span class="user-alert-cart">0</span>
                                </a>
                                <div class="cart-detail-box">
                                    <div class="card">
                                        <div class="card-header padding-15">Your Order</div>
                                        <div class="card-body no-padding" >
                                            <div class='addToHeaderCart' style="height: 300px; overflow: auto;">

                                            </div>
                 <div class="item-total">
                                                <div class="total-price border-0"> <span class="text-dark-white fw-700">Items subtotal:</span>
                                                    <span class="text-dark-white fw-700 final_price">0</span>
                                                </div>
                                                <div class="empty-bag padding-15"> <a href="javascript:void(0)" onclick="empty_cart();">Empty bag</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer padding-15"> <a href="{{ route('web_checkout') }}" class="btn-first green-btn text-custom-white full-width fw-500">Proceed to Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- user cart -->

                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-sm-12 mobile-search">
                        <div class="mobile-address">
                            <a href="javascript:void(0)" class="delivery-add" data-toggle="modal" data-target="#address-box"> <span class="address">Food Near me</span>
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

        </header>
    </div>
    <div class="section-padding">
@include('include.alerts')



    @yield('main_content')
    
    
