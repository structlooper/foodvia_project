@extends('website.layouts.webapp')

@section('title')
Hunger Wings | Food Delivery
@endsection

@section('main_content')

<section class="about-us-slider swiper-container p-relative">
    
    @include('include.alerts')
    <div class="swiper-wrapper">
        <div class="swiper-slide slide-item">
            <img src={{ asset("website/assets/img/about/blog/1920x700/banner-4.jpg") }} class="img-fluid full-width" alt="Banner">
            <div class="transform-center">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-7 align-self-center">
                            <div class="right-side-content">
                                <h1 class="text-custom-white fw-600">Increase takeout sales by 50%</h1>
                                <h3 class="text-custom-white fw-400">with the largest delivery platform in the U.S. and Canada</h3>
                                <a href="restaurant.html" class="btn-second btn-submit">Learn More.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide slide-item">
            <img src={{ asset("website/assets/img/about/blog/1920x700/banner-5.jpg") }} class="img-fluid full-width" alt="Banner">
            <div class="transform-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 align-self-center">
                            <div class="right-side-content text-center">
                                <h1 class="text-custom-white fw-600">Increase takeout sales by 50%</h1>
                                <h3 class="text-custom-white fw-400">with the largest delivery platform in the U.S. and Canada</h3>
                                <a href="restaurant.html" class="btn-second btn-submit">Learn More.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide slide-item">
            <img src={{ asset("website/assets/img/about/blog/1920x700/banner-6.jpg") }} class="img-fluid full-width" alt="Banner">
            <div class="transform-center">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-7 align-self-center">
                            <div class="right-side-content text-right">
                                <h1 class="text-custom-white fw-600">Increase takeout sales by 50%</h1>
                                <h3 class="text-custom-white fw-400">with the largest delivery platform in the U.S. and Canada</h3>
                                <a href="restaurant.html" class="btn-second btn-submit">Learn More.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</section>
<!-- slider -->
<!-- Browse by category -->
<section class="browse-cat u-line section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header-left">
                    <h3 class="text-light-black header-title title">Browse by cuisine {{ count($cuisine) }} <span class="fs-14"><a href="restaurant.html">See all restaurant</a></span></h3>
                </div>
            </div>
            <div class="col-12" id="thisIdforUrl" url={{ url('api') }}>
                <div class="category-slider swiper-container">
                    <div class="swiper-wrapper">

                        @foreach ($cuisine as $item)
                        <div class="swiper-slide">
                            <a href="{{ route('category',$item->id) }}" class="categories categoryWise">
                                <div class="icon text-custom-white bg-light-green ">
                                    <img  src={{ asset("website/assets/img/restaurants/125x125/cuisine-2.jpg") }}
                                      class="rounded-circle" alt="categories">
                                    {{-- <input type="hidden" class="categoryVal" value="{{ $item->id }}"> --}}
                                </div> <span class="text-light-black cat-name">{{ $item->name }} </span>
                            </a>
                        </div>
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
<section class="ex-collection section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header-left">
                    <h3 class="text-light-black header-title title">Explore our collections</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="ex-collection-box mb-xl-20">
                    <img src={{ asset("website/assets/img/restaurants/540x300/collection-1.jpg") }} class="img-fluid full-width" alt="image">
                    <div class="category-type overlay padding-15"> <a href="restaurant.html" class="category-btn">Top rated</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ex-collection-box mb-xl-20">
                    <img src={{ asset("website/assets/img/restaurants/540x300/collection-2.jpg") }} class="img-fluid full-width" alt="image">
                    <div class="category-type overlay padding-15"> <a href="restaurant.html" class="category-btn">Top rated</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="banner-adv2 mb-xl-20">
                    <img src={{ asset("website/assets/img/restaurants/1110x100/vbanner-2.jpg") }} class="img-fluid full-width" alt="banner"> <span class="text">Unlimited Free Delivery with. <img src={{ asset("website/assets/img/tag.jpg") }} alt="logo">
                        <a href="restaurant.html" class="btn-second btn-submit">Try 30 Days FREE</a></span>
                    <span class="close-banner"></span>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="large-product-box mb-xl-20 p-relative">
                    <img src={{ asset("website/assets/img/restaurants/255x587/Banner-12.jpg") }} class="img-fluid full-width" alt="image">
                    <div class="category-type overlay padding-15">
                        <button class="category-btn">Most popular near you</button> <a href="restaurant.html" class="btn-first white-btn text-light-black fw-600 full-width">See all</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="row" id="append_after_this">
{{-- {{ print_r($product) }} --}}
                    <div >
                        
                    </div>
                    @foreach ($shops as $item)
                    @if ($item->status == 'active')
                        
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 currentCards">
                        <div class="product-box mb-xl-20">
                            <div class="product-img">
                                <a href="#">
                                    <img 
                                    {{-- @if (@getimagesize($item->avatar))
                                    src={{ $item->avatar }}
                                    @else --}}
                                    src={{ asset("website/assets/img/restaurants/255x150/shop-7.jpg") }}
                                    {{-- @endif   --}}
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
                            <h6 class="product-title" style="width: 50%; text-overflow: hidden;" ><a href="{{ route('restaurant',$item->id) }}" class="text-light-black " > {{ $item->name }}</a></h6>
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




                </div>
            </div>
        </div>


    </div>
</section>
    
@endsection

@section('js')
    <script src="{{ asset('website/assets/js/pages/hunger_wings.js') }}"></script>
@endsection
