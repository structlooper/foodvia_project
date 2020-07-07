@extends('website.layouts.webapp')

@section('title')
    Hunger Wings | Food Delivery
@endsection

@section('main_content')


    <!-- slider -->
    <!-- Browse by category -->
    <section class="browse-cat u-line p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header-left">
                        <h3 class="text-light-black header-title title">Browse by cuisine {{ $cuisineCount }} <span class="fs-14"><a href="{{ route('all_restro') }}">See all restaurant</a></span></h3>
                    </div>
                </div>
                <div class="col-12" id="thisIdforUrl" url={{ url('api') }}>
                    <div class="category-slider swiper-container">
                        <div class="swiper-wrapper">

                            @foreach ($cuisine as $value)
                                @foreach( $value as  $item)

                                <div class="swiper-slide">
                                    <a href="{{ route('category',$item->id) }}" class="categories categoryWise">
                                        <div class="icon text-custom-white bg-light-green ">
                                            <img  src={{ asset("website/assets/img/restaurants/125x125/cuisine-2.jpg") }}
                                                    class="rounded-circle" alt="categories">
                                            <input type="hidden" class="categoryVal" value="{{ $item->id }}">
                                        </div> <span class="text-light-black cat-name">{{ $item->name }} </span>
                                    </a>
                                </div>
                                @endforeach
                            @endforeach

                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Browse by category -->
    <!-- Explore collection -->
    <section class="ex-collection p-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header-left">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="large-product-box mb-xl-20 p-relative">
                        <img src="{{ asset("website/assets/img/restaurants/255x587/Banner-12.jpg") }}" class="img-fluid full-width" alt="image">
                        <div class="category-type overlay padding-15">
                            <button class="category-btn">Most popular near you</button> <a href="{{ route('all_restro') }}" class="btn-first white-btn text-light-black fw-600 full-width">See all</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="row" id="append_after_this">
                        {{-- {{ print_r($product) }} --}}
                        <div >

                        </div>
                        @if (sizeof($shops) > 0)
                            @foreach ($shops as $item)
                                @if ($item->status == 'active')


                                    <div class="col-lg-4 col-md-6 col-sm-6 currentCards">
                                        <div class="product-box mb-xl-20">
                                            <div class="product-img">
                                                <a href="javascript:void(0)">
                                                    <img
                                                            @if (@getimagesize($item->avatar))
                                                                src={{ $item->avatar }} 
                                                            @else
                                                            src="{{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }}"
                                                             @endif 
                                                            class="img-fluid full-width" style="height:200px;" alt="product-img">
                                                </a>
                                                <div class="overlay">
                                                    <div class="product-tags padding-10"> <span class="circle-tag">
                                            <img src={{ asset("website/assets/img/svg/013-heart-1.svg") }} alt="tag">
                                        </span>
                                                        @if ($item->pure_veg == 1)

                                                            <span class="type-tag bg-gradient-green text-custom-white">
                                        pure Veg
                                    </span>
                                                        @endif
                                                        <div class="custom-tag"> <span class="text-custom-white rectangle-tag bg-gradient-red">
                                         {{ $item->offer_percent }}%
                                        </span>
                                                            @if ($item->popular == 1)

                                                                <span class="text-custom-white rectangle-tag bg-gradient-green">
                                            Popular
                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="title-box">
                                                    <h6 class="product-title" style="width: 50%;" ><a href="{{ Route('restaurant',$item->id) }}" class="text-light-black " > {{ $item->name }}</a></h6>
                                                    <div class="tags"> <span class="text-custom-white rectangle-tag bg-yellow">
                                    {{ $item->rating }}
                                </span>
                                                    </div>
                                                </div>
                                                <p class="text-light-white">{{ $item->description }}</p>
                                                <div class="product-details">
                                                    <div class="price-time"> <span class="text-light-black time">{{ $item->estimated_delivery_time }} mins</span><span class="m-auto">  </span>
                                                        <span class="text-light-white price"> {{ $item->offer_min_amount }} rupee min</span>
                                                    </div>
                                                    <div class="rating"> <span>
                                    <i class="fas fa-star text-yellow"></i>
                                    <i class="fas fa-star text-yellow"></i>
                                    <i class="fas fa-star text-yellow"></i>
                                    <i class="fas fa-star text-yellow"></i>
                                    <i class="fas fa-star text-yellow"></i>
                                </span>
                                                        <span class="text-light-white text-right"></span>
                                                    </div>
                                                </div>
                                                <div class="product-footer"> <span class="text-custom-white square-tag">
                            <img src={{ asset("website/assets/img/svg/004-leaf.svg") }} alt="tag">
                        </span>
                                                    <span class="text-custom-white square-tag">
                            <img src={{ asset("website/assets/img/svg/006-chili.svg") }} alt="tag">
                        </span>
                                                    <span class="text-custom-white square-tag">
                                <img src={{ asset("website/assets/img/svg/005-chef.svg") }} alt="tag">
                            </span>
                                                    <span class="text-custom-white square-tag">
                                <img src={{ asset("website/assets/img/svg/008-protein.svg") }} alt="tag">
                            </span>
                                                    <span class="text-custom-white square-tag">
                                <img src={{ asset("website/assets/img/svg/009-lemon.svg") }} alt="tag">
                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else

                            <h1>No restaurants found</h1>

                        @endif



                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('website/assets/js/pages/hunger_wings.js') }}"></script>
@endsection
