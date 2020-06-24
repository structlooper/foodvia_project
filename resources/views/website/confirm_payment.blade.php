@extends('website.layouts.webapp')

@section('title')
    Hunger Wings | Food Delivery
@endsection

@section('main_content')

{{--    {{ $status }}--}}
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

@endsection