<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="#">
    <meta name="description" content="#">
{{-- <title>Foodvia | Food Delivery</title> --}}
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

</head>

<body>

    <div class="row">

    <div class="col-lg-4"></div>
    <div class="text-center col-lg-5 p-5">
        <div class="sidebar">
            <div class="cart-detail-box">
                <div class="card">
                    <div class="card-header padding-15 fw-700">Your order from
                        <p class="text-light-white no-margin fw-500">{{ ucfirst(Auth::user()->name) }}</p>
                    </div>
                    <div class="card-body no-padding" id="scrollstyle-4">
                                                        @foreach( $product_details as $key => $item )
                                                        <div class="cat-product-box">
                                                            <div class="cat-product">
                                                                <div class="cat-name text-left" style="width: 300px;">
                                                                    <a href="#">
                                                                        <p class="text-light-green fw-700"> {{$item->name}}</p> <span class="text-light-white fw-700">{{ $item->description }}</span>
                                                                    </a>
                                                                </div>
{{--                                                                <div class="delete-btn">--}}
{{--                                                                    <a href="#" class="text-dark-white"> <i class="far fa-trash-alt"></i>--}}
{{--                                                                    </a>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="price"> <a href="#" class="text-dark-white fw-500">--}}
{{--                                                                    {{ $item->price }} ₹--}}
{{--                                                                                    </a>--}}
{{--                                                                </div>--}}
                                                            </div>
                                                        </div>
                                                        @endforeach
                        <div class="item-total">

                        </div>
                    </div>

                    <div class="card-footer p-0 modify-order">
                        <div class=" p-3 text-right">

                            <div class="total-price border-0 pb-0"> <span class="text-dark-white fw-600">Items subtotal:</span>
                                <span class="text-dark-white fw-600 "> {{ $total_price }} ₹</span>
                            </div>
                            <div class="total-price border-0 pt-0 pb-0"> <span class="text-light-green fw-600">Delivery fee:</span>
                                <span class="text-light-green fw-600">Free</span>
                            </div>
                            @if ($promode_details !== 0)
                                 <div class=" border-0 pt-0 pb-0 promo_code_info_area" > <span class="text-success "><B>{{ $promode_details->promo_code }} :</B></span>
                                     <span class="text-light-green fw-600"><a href="#" data-toggle="modal" data-target="#promoCodeModal">- {{ $promode_details->discount }} {{ $type_of }}</a></span>
                                </div>

                            @endif
                            <a href="#" > <span class="text-dark">GRAND TOTAL :</span>
                                <span class=" text-dark"><B>{{ $grand_price }} ₹</B></span></a>
                        </div>


                        <div class="total-amount text-right">

                        <form action="{!!route('payment')!!}" method="POST" >
                            <!-- Note that the amount is in paise = 50 INR -->
                            <!--amount need to be in paisa-->
                            <script id="paymentGatewayScript" src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ Config::get('custom.razor_key') }}"
                                    data-amount="{{ $grand_price * 100 }}"
                                    data-buttontext="Procedue to pay"
                                    data-name="Order"
                                    data-description="Hunger Wings"
                                    data-image="{{ asset("website/assets/img/hunger_wings1.png") }}"
                                    data-prefill.name="{{ Auth::user()->name }}"
                                    data-prefill.email="{{ Auth::user()->email }}"
{{--                                    data-theme.color=""--}}
                            >
                            </script>
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <input type="hidden" name="order_id" value="{{ $order_id }}">
                            <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src={{ asset("website/assets/js/popper.min.js") }}></script>
    <!-- Bootstrap -->
    <script src={{ asset("website/assets/js/bootstrap.min.js") }}></script>
    <!-- Range Slider -->
    <script src={{ asset("website/assets/js/ion.rangeSlider.min.js") }}></script>
    <!-- Swiper Slider -->
    <script src={{ asset("website/assets/js/swiper.min.js") }}></script>
    <!-- Nice Select -->
    <script src={{ asset("website/assets/js/jquery.nice-select.min.js") }}></script>
    <!-- magnific popup -->
    <script src={{ asset("website/assets/js/jquery.magnific-popup.min.js") }}></script>
    <!-- Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZJvjfei1Tbyo9xH4Supe_4enBrCEdhV0&libraries=places&callback=initMap"
            async defer></script>
    <script src={{ asset('website/assets/js/pages/google_map.js') }}></script>
    <!-- sticky sidebar -->
    <script src={{ asset("website/assets/js/sticksy.js") }}></script>
    <!-- Munch Box Js -->
    <script src={{ asset("website/assets/js/munchbox.js") }}></script>

    <script src="{{ asset('jquery-toast-plugin-master/dist/jquery.toast.min.js') }}"></script>

    <script src="{{ asset('website/assets/js/pages/header.js') }}"></script>
    <!-- /Place all Scripts Here -->
    {{-- page specific js --}}
</body>
</html>