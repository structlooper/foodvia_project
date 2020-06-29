@extends('website.layouts.webapp')
@section('title')
Hunger Wings | Register
@endsection

@section('main_content')
<div class="inner-wrapper section-padding" >
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
              <div class="login-box section-padding">
                  <h6 class="text-light-black fw-600">Create your account</h6>
                <form  class="popup-form" method="POST" id="register_form" action="{{ url('/register') }}">

                  {{ csrf_field() }}
                  <div class="row">

                    <div class="col-12">
                      <div class="form-group">
                        <label class="text-light-white fs-14">Name</label>
                        <input type="text" name="name" class="form-control form-control-submit" placeholder="Name" required>
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">phone</label>
                        <input type="text" name="phone" class="form-control form-control-submit" placeholder="phone number" >
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">Email</label>
                        <input type="email" id="email-field" name="email" class="form-control form-control-submit"  placeholder="email" required>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6">
                          <label class="text-light-white fs-14">Password <span class="text-danger">(mini char 6)</span></label>
                        <input type="password" id="password-field" name="password" class="form-control "  placeholder="Password" required>
                        <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                        </div>
                        <div class="col-sm-6">
                          <label class="text-light-white fs-14">Confirm Password </label>
                          <input type="password" id="c_password-field" name="password_confirmation" class="form-control"  placeholder="Confirm Password" required>
                          <div data-name="#c_password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                        </div>
                      </div>
                      <div class="form-group">

                      </div>
                      <div class="form-group checkbox-reset">
                        <label class="custom-checkbox mb-0">
                          <input type="checkbox" name="#" id="check_2" checked> <span class="checkmark"></span> By creating your Hunger account, you agree to the
                          Terms of Use
                          and
                          Privacy Policy.</label>
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn-second btn-submit full-width register_btn">Create your account</button>
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
                      <div class="form-group text-center">
                        <p class="text-light-black mb-0">Have an account? <a href="{{ route('web_login') }}">Sign in</a>
                        </p>
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
@endsection

@section('js')
  <script src="{{ asset('website/assets/js/pages/register_page.js') }}" ></script>
@endsection