@extends('website.layouts.webapp')
@section('title')
Hunger Wings | Checkout
@endsection

@section('main_content')
<section class="final-order p-2 bg-light-theme">
    @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade in" style="opacity: 1!important;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Error!</strong> {{ $message }}
        </div>
    @endif
    {!! Session::forget('error') !!}
    @if($message = Session::get('success'))
        <div class="alert alert-info alert-dismissible " style="opacity: 1!important;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif
    {!! Session::forget('success') !!}
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-lg-9">
                <div class="main-box padding-20">
                    <div class="row mb-xl-20">
                        <div class="col-md-6">
                            <div class="section-header-left">
                                <h3 class="text-light-black header-title fw-700">Review and place order</h3>
                            </div>
                            <h6 class="text-light-black fw-700 fs-14">Review address, payments, and tip to complete your purchase</h6>
                            <h6 class="text-light-black fw-700 mb-2">Your order Delivery Address</h6>
{{--                            <p class="text-light-green fw-600">Delivery, ASAP (60-70m)</p>--}}
                            <p class="text-light-white title2 mb-1">{{ ucfirst(Auth::user()->name) }}
{{--                                <span><a href="#">Change Details</a></span>--}}
                            </p>
                            <p class="text-light-white">{{ Auth::user()->phone }}</p>

                        @foreach($user_address as $key => $item)
                                @if (!is_null($item))
                                    <div class="form-group border p-2">
                                        <label class="custom-checkbox">
                                            <p class="text-light-black fw-600 mb-1">{{ $item->type }}</p>
                                            <input type="radio"  name="address_id" value="{{ $item->id }}"> <span class="checkmark"></span>
                                            <p class="text-light-white mb-1">{{ $item->building }} {{ $item->street }},
                                               <br>
                                                {{ $item->landmark }}
                                            </p>
                                            <p class="text-light-white mb-1">{{ $item->map_address }} , {{ $item->pincode }}
                                            </p>
                                        </label>
                                    </div>

                                @else
                                    Please add delivery address..
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <img src={{ asset("website/assets/img/checkout.jpg") }} class="img-fluid full-width" alt="advertisement-img">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="payment-sec">

                                <div class="section-header-left">
                                    <h3 class="text-light-black header-title">Payment information</h3>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="accordion">
                                            <div class="payment-option-tab">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item"> <a class="nav-link fw-600 active" data-toggle="tab" href="#OnlinePayment">Online Payment</a>
                                                    </li>
                                                    <li class="nav-item"> <a class="nav-link fw-600" data-toggle="tab" href="#cash">Cash</a>
                                                    </li>


                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="OnlinePayment">
                                                        <div class="section-header-left">
                                                            <h3 class="text-light-black header-title">Pay Online With Razorpay </h3>
                                                        </div>

                                                        <p class="text-light-black">Safe and Secure Payment</p>
                                                        <div class="form-group">
                                                            <label class="custom-checkbox">
{{--                                                                     <input type="checkbox" name="#"> <span class="checkmark">--}}

                                                                </span>
                                                                By placing your order, you agree to Foodvia's <a href="#">terms of use</a> and <span><a href="#">privacy agreement</a></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">

                                                            <button type="button" url="{{ route('pay_online') }}" id="place_order_online" class="btn-first green-btn text-custom-white full-width fw-500" style="height: 4rem;"><span > Place Your Order</span></button>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="cash">
                                                        <div class="section-header-left">
                                                            <h3 class="text-light-black header-title">Cash on delivery</h3>
                                                        </div>
                                                        <p class="text-light-black">Have the cash ready when you receive your order.</p>
                                                        <div class="form-group">
                                                            <label class="custom-checkbox">
{{--                                                                <input type="checkbox" name="#"> <span class="checkmark">--}}

                                                                </span>
                                                                By placing your order, you agree to Foodvia's <a href="#">terms of use</a> and <a href="#">privacy agreement</a></span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" id="promoce_id_01">
                                                            <button type="button" onclick="place_order();"   class="btn-first green-btn text-custom-white full-width fw-500" style="height: 4rem;">Place Your Order</button>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="cart-detail-box">
                        <div class="card">
                            <div class="card-header padding-15 fw-700">Your order from
                                <p class="text-light-white no-margin fw-500">{{ ucfirst(Auth::user()->name) }}</p>
                            </div>
                            <div class="card-body no-padding" id="scrollstyle-4">
                                <div class="addToHeaderCart">

                                </div>

                                <div class="item-total">

                                </div>
                            </div>
{{--                            <button class="text-custom-white full-width fw-500 bg-light-green"><i class="fas fa-chevron-left mr-2"></i>Go back to modify Your Order</button>--}}

                            <div class="card-footer p-0 modify-order">
                                <div class=" p-3 text-right">

                                <div class="total-price border-0 pb-0"> <span class="text-dark-white fw-600">Items subtotal:</span>
                                    <span class="text-dark-white fw-600 final_price" id="final_price_this"></span>
                                </div>
                                <div class="total-price border-0 pt-0 pb-0"> <span class="text-light-green fw-600">Delivery fee:</span>
                                    <span class="text-light-green fw-600">Free</span>
                                </div>

                                <div class=" border-0 pt-0 pb-0 promo_code_info_area" > <span class="text-success "><B>Have Promo code:</B></span>
                                    <span class="text-light-green fw-600"><a href="#" data-toggle="modal" data-target="#promoCodeModal">Click</a></span>
                                </div>
                                </div>



                                <a href="#" class="total-amount"> <span class="text-custom-white fw-700">GRAND TOTAL</span>
                                    <span class="text-custom-white fw-700 grand_total final_price">0</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
   <!-- footer -->

<div class="modal fade" id="promoCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apply Promo code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="#" method="post" >
                <div class="row">
                        {{ csrf_field() }}
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="promocode_input" placeholder="Enter Code here" style="width: 15rem;">
                    </div>
                    <div class="col-sm-6 text-center">
                        <button type="button"  class="btn btn-success apply_promo" style="width: 10rem; ">Apply</button>
                    </div>
                </div>
                    </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')
  <script src="{{ asset('website/assets/js/pages/checkout.js') }}"></script>
@stop