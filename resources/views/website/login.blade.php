@extends('website.layouts.webapp')
@section('title')
Hunger Wings | Login
@endsection

@section('main_content')
<div class="inner-wrapper mt-2">
    <div class="container-fluid no-padding">
      <div class="row no-gutters overflow-auto">
        <div class="col-md-6">
          <div class="main-banner">
            <img src={{ asset("website/assets/img/banner/banner-1.jpg") }} class="img-fluid full-width main-img" alt="banner">
            <div class="overlay-2 main-padding">
              <img src={{ asset("website/assets/img/food-via.jpg") }} class="img-fluid" alt="logo">
            </div>
            <img src={{ asset("website/assets/img/banner/burger.html") }} class="footer-img" alt="footer-img">
          </div>
        </div>
        <div class="col-md-6">
          <div class="section-2 user-page main-padding">
            <div class="login-sec">
              <div class="login-box">
                <form role="form" method="POST" action="{{ route('login') }}"  id="login_form" url="{{url('/login')}}">
                  <div id="login_form_error" class="print-error-msg"><ul class="alert-danger list-unstyled"></ul></div>
                  {{ csrf_field() }}
                  <h4 class="text-light-black fw-600">Sign in with your Hunger account</h4>
                  <div class="row">
                    <div class="col-12">
{{--                      <p class="text-light-black">Have a corporate username? <a href="add-restaurant.html">Click here</a>--}}
{{--                      </p>--}}
                      <div class="form-group">
                        <label class="text-light-white fs-14">Phone</label>
                        <input type="text" name="#" id="phone-field" class="form-control form-control-submit" placeholder="Enter your phone number with +91" required>
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">Password</label>
                        <input type="password" id="password-field" name="#" class="form-control form-control-submit"  placeholder="Password" required>
                        <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                      </div>
                      <div class="form-group checkbox-reset">
                        <label class="custom-checkbox mb-0">
                          <input type="checkbox" name="#"> <span class="checkmark"></span> Keep me signed in</label> <a href="#">Reset password</a>
                      </div>
                      <div class="form-group">
                        <button type="button"  class="btn-second btn-submit full-width login_btn">
                          <img src={{ asset("website/assets/img/M.png") }} alt="btn_logo">Sign in</button>
                      </div>
                      <div class="form-group text-center"> <span>or</span>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-facebook full-width">
                          <img src={{ asset("website/assets/img/facebook-logo.svg") }} alt="btn_logo">Continue with Facebook</button>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-google full-width">
                          <img src={{ asset("website/assets/img/google-logo.png") }} alt="btn_logo">Continue with Google</button>
                      </div>
                      <div class="form-group text-center mb-0"> <a href="{{ route('web_register') }}">Create your account</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{{--@include('user.layouts.partials.script')--}}
@endsection

@section('js')
  <script src="{{ asset('website/assets/js/pages/login_page.js') }}"></script>

@endsection

