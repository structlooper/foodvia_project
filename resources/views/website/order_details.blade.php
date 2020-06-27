@extends('website.layouts.webapp')
@section('title')
Hunger Wings | Order Details
@endsection

@section('css')
    <style>
        .myDisabled{
            display: none;
        }
    </style>
@endsection

@section('main_content')

    <section class="checkout-page section-padding bg-light-theme">
        <div class="container">


            @foreach( array_reverse($orders) as $key => $item)

            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="tracking-sec" >
                        <div class="padding-20 p-relative"  style="width: 80%!important;">
                            <h5 class="text-light-black fw-600">Order {{ $key+1 }}  -#<span class="text-muted">{{ $item[0]->status }}</span></h5>
                            <span class="text-light-white">Estimated Delivery time</span>
                            <?php
                            $added_time =
                                Carbon\Carbon::parse($item[0]->created_at)->addMinutes( intval($item[0]->estimated_delivery_time))
                            ;
                            ?>
                            <h2 class="text-light-black fw-700 no-margin">{{ date('h:i a',strtotime($item[0]->created_at) ) }}-{{ date('h:i a',strtotime($added_time)) }} ({{ $item[0]->estimated_delivery_time }} mins)</h2>
                            <div id="add-listing-tab" class="step-app">
                                <ul class="step-steps" id="findOrderStatus{{$key}}" status="{{ $item[0]->status}}">
                                    <script>
                                        $(document).ready(function(){
                                            let status = $('#findOrderStatus{{$key}}').attr('status')
                                            if (status === 'ORDERED'){
                                                $('#ordered_first{{$key}}').addClass('active')
                                            }
                                            else if(status === 'PROCESSING'){
                                                $('#ordered_first{{$key}}').addClass('done')
                                                $('#process_second{{$key}}').addClass('active')
                                            }
                                            else if(status === 'PICKEDUP'){
                                                $('#ordered_first{{$key}}').addClass('done')
                                                $('#process_second{{$key}}').addClass('done')
                                                $('#out_for_delivery_third{{$key}}').addClass('active')
                                            }
                                            else if(status === 'COMPLETED'){
                                                $('#ordered_first{{$key}}').addClass('done')
                                                $('#process_second{{$key}}').addClass('done')
                                                $('#out_for_delivery_third{{$key}}').addClass('done')
                                                $('#completed_forth{{$key}}').addClass('active')
                                            }

                                        })
                                    </script>
                                    <li class="" id="ordered_first{{$key}}">
                                        <a href="javascript:void(0)"> <span class="number"></span>
                                            <span class="step-name">Order sent<br>{{ date('h:i a', strtotime($item[0]->created_at)) }}</span>
                                        </a>
                                    </li>
                                    <li class="" id="process_second{{$key}}">
                                        <a href="javascript:void(0)"> <span class="number"></span>
                                            <span class="step-name">In the works</span>
                                        </a>
                                    </li>
                                    <li class="" id="out_for_delivery_third{{$key}}">
                                        <a href="javascript:void(0)"> <span class="number"></span>
                                            <span class="step-name">Out of delivery</span>
                                        </a>
                                    </li>
                                    <li id="completed_forth{{$key}}">
                                        <a href="javascript:void(0)"> <span class="number"></span>
                                            <span class="step-name">Delivered</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="append{{$key}}">

                                <button type="button" onclick="showDetails({{$key}});" class=" mt-3 btn btn-block btn-outline-danger border-0 text-light-black fw-600 "  >Show more details</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- recipt -->
                    <div class="recipt-sec padding-20" id="show{{$key}}" style="display: none;">
                        <div class="recipt-name title u-line full-width mb-xl-20">
                            <div class="recipt-name-box">
                                <h5 class="text-light-black fw-600 mb-2">{{ $item[0]->name }}</h5>
                                <p class="text-light-white ">{{ $item[0]->address }}</p>
                            </div>
                        </div>
                        <div class="u-line mb-xl-20">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="recipt-name full-width padding-tb-10 pt-0">
                                        <h5 class="text-light-black fw-600">Delivery (ASAP) to:</h5>
                                        <span class="text-light-white ">{{ ucfirst(Auth::user()->name) }}</span>
                                        <span class="text-light-white ">{{ $item[0]->type }}</span>
                                        <span class="text-light-white ">{{ $item[0]->building }}</span>
                                        <span class="text-light-white ">{{ $item[0]->street }}{{ $item[0]->city }} , {{ $item[0]->state }}, {{ $item[0]->country }}, {{ $item[0]->pincode }}</span>
                                        <p class="text-light-white ">{{ Auth::user()->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="recipt-name full-width padding-tb-10 pt-0">
                                        <h5 class="text-light-black fw-600">Delivery LandMark</h5>
                                        <p class="text-light-white ">{{ $item[0]->landmark }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="ad-banner padding-tb-10 h-100">
                                        <img src="{{ asset("website/assets/img/details/banner.jpg") }}" class="img-fluid full-width" alt="banner-adv">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-line mb-xl-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5 class="text-light-black fw-600 title">Your Order <span><a href="#" class="fs-12">Print recipt</a></span></h5>
                                    <p class="title text-light-white">{{ date('F d, Y , H:i a', strtotime($item[0]->created_at)) }}<span class="text-light-black">Order : {{ $item[0]->invoice_id }}</span>
                                    </p>
                                </div>
                                <?php $data = App\Helper\ProductHelper::getCartProduct($item[0]->order_id) ?>

                                <div class="col-lg-12">
                                @foreach( $data as  $value)
                                    <div class="checkout-product">
                                        <div class="img-name-value">
                                            <div class="product-value"> <span class="text-light-white">{{ $value->quantity }}</span>
                                            </div>
                                            <div class="product-name"> <span><a href="#" class="text-light-white">{{ $value->name}}</a></span>
                                            </div>
                                        </div>
                                        <?php $price = App\Helper\ProductHelper::getProductPrice($value->product_id) ?>
                                        <div class="price"> <span class="text-light-white">{{ $price->price * $value->quantity }} ₹</span>
                                        </div>
                                    </div>
                                    @endforeach


                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="payment-method mb-md-40">
                                    <h5 class="text-light-black fw-600">Payment Method</h5>
                                    <div class="method-type"> <i class="far fa-credit-card text-dark-white"></i>
                                        <span class="text-light-white">@if ( $item[0]->payment_mode  == 'cash')
                                            Cash on delivery
                                            @else
                                                                           Online Payment
                                        @endif</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="price-table u-line">
                                    <div class="item"> <span class="text-light-white">Item subtotal:</span>
                                        <span class="text-light-white">{{ $item[0]->total_pay }} ₹</span>
                                    </div>
                                    <div class="item"> <span class="text-light-white">Delivery fee:</span>
                                        <span class="text-light-white">{{ $item[0]->delivery_charge }} ₹</span>
                                    </div>
                                    <div class="item"> <span class="text-light-white">Tax and fees:</span>
                                        <span class="text-light-white">{{ $item[0]->tax }} ₹</span>
                                    </div>
                                    @if ($item[0]->discount > 0)

                                    <div class="item"> <span class="text-light-white">Discount :</span>
                                        <span class="text-light-red">- {{ $item[0]->discount }} ₹</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="total-price padding-tb-10">
                                    <h5 class="title text-light-black fw-700">Total: <span>{{ $item[0]->payable }} ₹</span></h5>
                                </div>
                            </div>
                            <div class="col-12 d-flex"> <a href="#" class="btn-first white-btn fw-600 help-btn">Need Help?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            @endforeach
        </div>
    </section>
    <!-- tracking map -->
   
@endsection

@section('js')
    <script>
        function showDetails(id){
            $('#show'+id).show('slow')
            $('.append'+id).html(`<button type="button" onclick="hideDetails(${id});" class=" mt-3 btn btn-block btn-outline-danger border-0 text-light-red fw-600"  >Hide more details</button>`)


        }
        function hideDetails(id){
            $('#show'+id).hide('slow')
            $('.append'+id).html(`<button type="button" onclick="showDetails(${id});" class=" mt-3 btn btn-block btn-outline-danger border-0 text-light-red fw-600"  >Show more details</button>`)

        }

        $(document).ready(function() {
            // Call refresh page function after 5000 milliseconds (or 60 seconds).
            setInterval('refreshPage()', 60000);
        });

        function refreshPage() {
            location.reload();
        }
    </script>
@endsection