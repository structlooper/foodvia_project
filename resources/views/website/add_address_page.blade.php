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
@include('include.alerts')
<div  id="update_user_addess " style="padding: 2rem;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="{{ route('user_profile') }}" class="btn btn-primary" style="width: 10rem;"><i class="fa fa-arrow-left"></i> Go back</a>
                <h5 class="modal-title" id="exampleModalLabel">Add address</h5>

            </div>
            <form action="{{ route('add_new_address') }}" method="post" id="address-save-form">
                {{ csrf_field() }}
                <div class="modal-body" style="padding:2rem;">
                    <div class="form-group">
                        <label for="example-Input-type">Address type </label>
                        <div class="row border-bottom">
                            <div class="col-sm">
                                <label>
                                    <input type="radio" name="type" id="example-Input-type1" value="home" aria-describedby="type-Help" >
                                    <h5>Home</h5>
                                </label>
                            </div>
                            <div class="col-sm">
                                <label>

                                    <input type="radio" name="type" id="example-Input-type2" value="office" aria-describedby="type-Help" >
                                    <h5>Office</h5>
                                </label>
                            </div>
                            <div class="col-sm">
                                <label>

                                    <input type="radio" name="type" id="example-Input-type3" value="others"aria-describedby="type-Help" >
                                    <h5>Other</h5>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-Input-building">Building </label>
                        <input type="text" class="form-control" id="example-Input-building" name="building" aria-describedby="building-Help" placeholder="Enter building, house no. etc">
                    </div>
                    <div class="form-group">
                        <label for="example-Input-street">Street<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="example-Input-street" name="street"  aria-describedby="street-Help" placeholder="Enter street">
                    </div>
                    <div class="form-group">
                        <label for="example-Input-landmark">Landmark <span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="example-Input-landmark" name="landmark"  aria-describedby="landmark-Help" placeholder="Enter landmark">
                    </div>

                    <div class="form-group">
                        <label for="example-Input-location">Location </label>
                        <form action="javaScript:void(0)">
                        <input type="text"  id="pac-input" class="form-control"  placeholder="Add new address"  autocomplete="off">
                        </form>
                            <div class="map"></div>
                            <input type="hidden" id="lat" name="latitude" >
                            <input type="hidden" id="lng" name="longitude" >
                            <input type="hidden" name="search_loc" id="location">

                    </div>
                    <div class="form-group">
                        <label for="example-Input-pin-code">pin code </label>
                        <input type="text" class="form-control" id="example-Input-pin-code" name="pin_code" aria-describedby="pin-code-Help" placeholder="Enter pin-code">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="submitForm();" class="btn btn-primary btn-block">Save address</button>
                </div>
            </form>
            <script>
                  function submitForm(){
                    $('#address-save-form').submit();
                }
            </script>
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
