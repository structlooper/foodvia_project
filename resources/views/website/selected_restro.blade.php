@extends('website.layouts.webapp')

@section('title')
Hunger Wings | Food Delivery
@endsection

@section('css')
    <style>
        .disabled{
            display: none;
        }
            .sidenav {
            width: 330px;
            z-index: 1;
            /* top: 20px; */
            left: 10px;
            background: #ffffff;
            overflow-x: hidden;
            padding: 8px 0;
            }

            .sidenav a {
            /* margin-left: 100px; */
            text-align: right;
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 15px;
            color: black;
            display: block;
            }

            .sidenav a:hover {
            color: red;
            }
            .sublinks:hover {
            color: rgb(255, 238, 0) !important;
            }
            .sublinks{
                /* text-align: right !important; */
                /* padding: 6px 8px 6px 16px; */
                /* padding-right: 50px !important;  */
                /* margin-right: 6px; */
                text-decoration: none !important;
                font-size: 12px !important;
                color: rgb(33, 131, 243) !important;
                display: block !important;

            }

            .working {
                font-size: 18px !important;
            text-align: right !important; 
            color: red !important; 
            /* background-color:#ffbb00;  */
            text-decoration: none;
            }
            @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
            }



            .fixed_by_me{
                    top:100px;
                    position: fixed;
                    width: 22.8%;
                }    

            .positionType { 
                position: -webkit-sticky 
                }

            .my_div {
                    /* width:100px; */
                    max-height:320px;
                    overflow-y:auto;
                }
                .my_div::-webkit-scrollbar {
                    display: none;
                }
            

    </style>
@endsection
@section('main_content')

<div class="most-popular section-padding">
    <div class="footer-top p-2 bg-secondary" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-4 col-md-4 ml-5">
                    <img  src={{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }} alt="restro Image" style="height: 200px;">
                </div>
                <div class="col-sm-12 col-6 col-md-6 text-white">
                    <h2 class="text-white">
                        {{ $shop_data->name }}
                    </h2>
                    <p>
                        {{ $shop_data->description }}
                    </p>
                    <p>
                        {{ $shop_data->address }}
                    </p>
                    <div class="offer">
                        {{ $shop_data->offer_percent }} % off for order
                    </div>
                    <div class="row mt-4  text-center">
                        <div class="col-sm-4 border-right">
                            <h5 class="text-white">
                                <span class="badge badge-pill badge-warning">
                                    
                                    {{ $shop_data->offer_min_amount }} Rupees
                                </span>
                                <br> Minimum Order
                                </h5>
                           
                                
                        </div>
                        <div class="col-sm-4 border-right">
                            <h5 class="text-white">
                                <span class="badge badge-pill badge-success">
                                    
                                    {{ $shop_data->estimated_delivery_time }} Min only
                                </span>
                                <br> Delivery Time
                                </h5>
                            
                        </div>
                        <div class="col-sm-4">
                            {{ $shop_data->rating }}
                            <button class="text-yellow"><i class="fas fa-star"></i></button>
                                <br>
                                <h5 class="text-white">

                                    Ratings
                                </h5>
                        </div>
                    </div>
                    
                </div>
            
            </div>
        </div>
    </div>
        <div class="container-fluid">
            <div class="row">
                <aside class="col-lg-3 mb-md-40  " >
                    
                    <div class="mt-2 mb-2   positionType"  >
                        <div class="sidenav border-right pr-4">
                            <h4 class="text-center ">{{ $shop_data->name }}</h4>
                            <a href="#about" class="working" > Most-popular  <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                            <a href="#services" > Recomended  <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                            <a href="#clients" > More Popular varieties  <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                            <div class="my_div">
                            @foreach ($categories as $item)
                                   <a href="#clients" class="border-right sublinks "><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $item->name }}</a>
                                   @endforeach
                                </div> 
                            {{-- <a href="#contact" class="border-right">Contact</a> --}}
                          </div>
                        
                        
                        </div>                    
                        
                        {{-- </div> --}}
                    
                </aside>
                <div class="col-lg-6 browse-cat ">
                    <div class="row m-2 ">
                       
                            
                            @foreach ($product_details as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 currentCards">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="#">
                                            <?php $image = App\Helper\ProductHelper::getProductImage($item[0]->id) ?>
                                            <?php $data = App\Helper\ProductHelper::getProductPrice($item[0]->id) ?>
                                        
                                            
                                            <img 
                                            {{-- @if (@getimagesize($image->url)) --}}
                                            {{-- src={{ $image->url }} --}}
                                            {{-- @else --}}
                                            src={{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }}
                                            {{-- @endif   --}}
                                            class="img-fluid full-width" style="height:100px;" alt="product-img">
                                        </a>
                                        <div class="overlay">
                                            <div class="product-tags padding-10"> <span class="circle-tag">
                                                <img src={{ asset("website/assets/img/svg/013-heart-1.svg") }} alt="tag">
                                            </span>
                                            @if ($item[0]->food_type == 'veg')
                                                
                                            <span class="type-tag bg-gradient-green text-custom-white">
                                                pure Veg
                                            </span>
                                            @endif
                                            @if ($data->discount > 0)
                                            <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">
                                                 {{ $data->discount }} % off hurryUp!!
                                            </span>
                                            @else
                                                
                                            <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">
                                                hurry!!
                                            </span>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-caption">
                                <div class="title-box">
                                    <h6 class="product-title" style="width: 50%; text-overflow: hidden;" ><a href="restaurant.html" class="text-light-black " > {{ $item[0]->name }}</a></h6>
                                        <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">
                                            {{ $data->price }} {{ $data->currency }}
                                        </span>
                                </div>
                                    </div>
                                    <p class="text-light-white">{{ $item[0]->description }} {{ $item[0]->id }}</p>
                                    <div class="product-details">
                                        <div class="price-time"> <span class="text-light-black time">{{ $shop_data->estimated_delivery_time }} mins</span>
                                            <span class="text-light-white price"> </span>
                                        </div>
                                       
                                    </div>
                                    <div class="product-footer offset-auto" > 
                                        
                                    <button type="button" dataname="{{ $item[0]->name }}" currency="{{ $data->currency }}" dataprice="{{ $data->price }}" dataid={{ $item[0]->id }} class="btn btn-sm btn-outline-primary addToCart"><i class="fas fa-plus"></i> Add Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach
                          
                    </div>
                        
                </div>

                {{-- Cart ................... --}}
                <aside class="col-lg-3" >
                        
                    <div class=" mt-2 mb-2 card positionType" >
                        <h4 class="text-light-black fw-600 title-2 pl-2 pt-3">Cart</h4>
                        
                        <div class="item border"  >
                        <form action="#">
                            <div class="m-2 blankDiv">

                                Cart is empty Please add something delicious!!
                            </div>
                            <div class="sidebar" id="cradboxShow" style="display: none;">
                                <div class="cart-detail-box">
                                    <div class="card">
                                        {{-- <div class="card-header padding-15 fw-700">Your order from
                                            <p class="text-light-white no-margin fw-500">Jhon Deo</p>
                                        </div> --}}
                                        <div class="card-body no-padding" id="scrollstyle-4">
                                            <div class="" id="addDataCart">
                                               
                                            </div>
                                        </div>
                                        <div class="card-footer p-0 modify-order">
                                            
                                            <a href="#" class="total-amount"> <span class="text-custom-white fw-700">TOTAL</span>
                                                <span class="text-custom-white fw-700">$18.50</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="checkoutButton text-right m-2"  style="display: none;" >
                            <button type="submit" class="btn btn-primary btn-sm">Checkout <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                        </div>                    
                        
                        </div>
                    
                </aside>
            </div>
        </div>
    </div>
    

@endsection

@section('js')
    <script src="{{ asset('website/assets/js/pages/selected_restro.js') }}"></script>
    <script>
        // function to fix and static position of card and side category bar..
        $(function() {
    //caches a jQuery object containing the header element
        var header = $(".positionType");
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 300) {
                header.removeClass('positionType').addClass("fixed_by_me");
            } 
            else {
                header.removeClass("fixed_by_me").addClass('positionType');
            }
            
            topOfFooter = $('#footer').position().top;
            // Distance user has scrolled from top, adjusted to take in height of sidebar (570 pixels inc. padding).
            scrollDistanceFromTopOfDoc = $(document).scrollTop() + 670;
            // Difference between the two.
            scrollDistanceFromTopOfFooter = scrollDistanceFromTopOfDoc - topOfFooter;
            // If user has scrolled further than footer,
            if (scrollDistanceFromTopOfDoc > topOfFooter) {
                header.removeClass("fixed_by_me").addClass('positionType');
            } 
        });
    });
    </script>
@endsection