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

        .working {
            font-size: 18px !important;
            text-align: center !important;
            /* background-color:#ffbb00;  */
            text-decoration: none;
        }
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }



        .fixed_by_me{
            top:50px;
            position: fixed;
            width: 22.8%;
        }

        .positionType {
            position: -webkit-sticky
        }

        .my_div {
            /* width:100px; */
            max-height:400px;
            overflow-y:auto;
        }



    </style>
@endsection
@section('main_content')


    <div class="most-popular p-2">
        <div class="footer-top p-2 bg-secondary" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-4 col-md-4 ml-5">
                        <img  
                        
                        @if (@getimagesize($shop_data->avatar))
                        src={{ $shop_data->avatar }} 
                        @else
                        src={{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }} 
                        @endif 
                        alt="restro Image" style="height: 200px;">
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
                {{-- <aside class="col-lg-3 mb-md-40" >

                    <div class="mt-2 mb-2   positionType"   >
                        <div class="sidenav border-right pr-4">
                                    <a href="javascript:void(0);" class="btn btn-sm  sublinks working mainLink" ><i class="fa fa-arrow-right"  aria-hidden="true"></i> <span class="text-muted">Recommended</span></a>
                            <a href="#clients"  > More Popular varieties  <i class="fa fa-caret-left" aria-hidden="true"></i></a>
                            <div class="my_div">
                                @foreach ($categories as $key =>  $item)
                                    <a href="javascript:void(0);" class="btn btn-sm  sublinks item_class_str " key={{ $item->id }} id="item_{{ $item->id }}"><i class="fa fa-arrow-right"  aria-hidden="true"></i> {{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </aside> --}}
                <aside class="col-lg-3 mb-md-40 " id="sidebar-wrapper">
                     <div class="main-sidebar sidebar-style-2">
                    {{-- <div class="sidebar-brand">
                      <a href="index.html"> <img alt="image" src="assets/img/safewash-logo.png" class="header-logo" />
                      </a>
                    </div> --}}
                    <ul class="sidebar-menu border mt-2">
                        <li class="dropdown ">
                            <h3 class="p-2 text-center">Categories</h3>
                            
                          </li>
                          @foreach ($categories as $key =>  $item)
                      <li class="dropdown">
                        <button type="button" class="nav-link btn btn-block btn-outline-danger text-left item_class_str" key={{ $item->id }} id="item_{{ $item->id }}"><i class="fa fa-caret-right" aria-hidden="true"></i> <span >{{ $item->name }}</span></button>
                      </li>
                      @endforeach
                   
                     
                      
                      
                    </ul>
                     </div>
                  </aside>
                <div class="col-lg-6 browse-cat ">
                    <h4 class="text-left border-bottom mt-3 p-2">{{ ($shop_data->name) }} Categories</h4>
                    <div class="row m-2 " id="append_after_this">

                        @foreach ($productDetails as $item)
                            <div class="col-lg-4 col-md-6 col-sm-6 currentCards" style="">
                                <div class="product-box mb-xl-20">
                                    <div class="product-img">
                                        <a href="#">
                                            <?php $image = App\Helper\ProductHelper::getProductImage($item[0]->id) ?>
                                            <?php $data = App\Helper\ProductHelper::getProductPrice($item[0]->id) ?>

                                                <img
                                                        @if (@getimagesize($image->url))
                                                        src={{ $image->url }}
                                                        @else
                                                        src="{{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }}"
                                                        @endif  
                                                        class="img-fluid full-width" style="height:100px;" alt="product-img">
                                        </a>
                                        <div class="overlay">
                                            <div class="product-tags padding-10"> <span class="circle-tag">
                                                <img src="http://localhost/foodvia/public/website/assets/img/svg/013-heart-1.svg" alt="tag">
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
                                                </div>
                                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <div class="title-box">
                                            <h6 class="product-title" style="width: 50%; "><a href="javascript:void(0);" class="text-light-black ">{{ $item[0]->name }}</a></h6>
                                            <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">
                                            {{ $data->price }} {{ $data->currency }}
                                        </span>
                                            </div>
                                        </div>
                                        <p class="text-light-white">{{ $item[0]->description }}</p>
                                        <div class="product-details">
                                            <div class="price-time"> <span class="text-light-black time"></span>
                                                <span class="text-light-white price"> </span>
                                            </div>

                                        </div>
                                        <div class="product-footer offset-auto">

                                            <button type="button" id="dish{{ $item[0]->id }}"

                                                    onclick="add_to_cart({{ $item[0]->id }})" dataname="{{ $item[0]->name }}" currency="{{ $data->currency }}" dataprice="{{ $data->price }}" dataid="{{ $item[0]->id }}" class="btn btn-sm btn-outline-primary "><i class="fas fa-plus"></i> Add Item</button>
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
                            <div class="row">
                                <div class="col-sm-6 " >
                                    <h4 class="text-light-black fw-600 title-2 pl-3 pt-3">Cart</h4>

                                </div>
                                <div class="col-sm-6 emptyCart" style="text-align: center;margin-top: 20px;">

                                    <button type="button" onclick="empty_cart();" class="btn btn-sm btn-outline-danger text-light-black border-0 showItem01" style="display: none;"><i class="far fa-trash-alt"></i> Clear cart</button >
                                </div>
                            </div>
                            <div class="item border"  >
                                <form action="#">
                                    <div class="m-2 blankDiv">

                                        Cart is empty Please add something delicious!!
                                    </div>
                                    <div class="sidebar" id="cradboxShow" >
                                        <div class="cart-detail-box">
                                            <div class="card">

                                                <div class="card-body no-padding" id="scrollstyle-4">
                                                    <div  id="addDataCart">


                                                    </div>
                                                </div>
                                                <div class="card-footer p-0 modify-order showItem01" style="display: none;">

                                                    <a href="#" class="total-amount"> <span class="text-custom-white fw-700">TOTAL</span>
                                                        <span class="text-custom-white fw-700 final_price pr-4" ></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="checkoutButton text-right m-2"  >
                                        <a href="{{ route('web_checkout') }}" class="btn btn-primary btn-sm showItem01" style="display: none;">Checkout <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                    {{--                            @endif--}}

                                </form>
                            </div>

                        </div>

                    </aside>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addToCartForm" url="{{ url('api/add_to_cart') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            ...
                        </div>
                        <input type="hidden" id="product_id" name="product_id"/>

                        <div class="modal-footer">
                            <button type="button" onclick="saveData({{ $shop_data->id }})"  class="btn btn-block btn-success finalAddCart" id="addData"> Add item</button>
                        </div>
                    </form>
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
                    let header = $(".positionType");
                    $(window).scroll(function() {
                        let scroll = $(window).scrollTop();

                        if (scroll >= 300) {
                            header.removeClass('positionType').addClass("fixed_by_me");
                        }
                        else {
                            header.removeClass("fixed_by_me").addClass('positionType');
                        }

                        let topOfFooter = $('#footer').position().top;
                        // Distance user has scrolled from top, adjusted to take in height of sidebar (570 pixels inc. padding).
                        let scrollDistanceFromTopOfDoc = $(document).scrollTop() + 670;
                        // Difference between the two.
                        let scrollDistanceFromTopOfFooter = scrollDistanceFromTopOfDoc - topOfFooter;
                        // If user has scrolled further than footer,
                        if (scrollDistanceFromTopOfDoc > topOfFooter) {
                            header.removeClass("fixed_by_me").addClass('positionType');
                        }
                    });
                });
            </script>
@endsection