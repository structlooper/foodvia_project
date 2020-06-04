@extends('website.layouts.webapp')
@section('title')
Hunger Wings | Register
@endsection

@section('main_content')
<div class="inner-wrapper mt-4">
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
                <form>
                  <h4 class="text-light-black fw-600">Create your account</h4>
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                      <div class="form-group">
                        <label class="text-light-white fs-14">First name</label>
                        <input type="text" name="#" class="form-control form-control-submit" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                      <div class="form-group">
                        <label class="text-light-white fs-14">Last name</label>
                        <input type="text" name="#" class="form-control form-control-submit" placeholder="Last Name" required>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label class="text-light-white fs-14">Email</label>
                        <input type="email" name="#" class="form-control form-control-submit" placeholder="Email I'd" required>
                      </div>
                      <div class="form-group">
                        <label class="text-light-white fs-14">Password (8 character minimum)</label>
                        <input type="password" id="password-field" name="#" class="form-control form-control-submit" value="password" placeholder="Password" required>
                        <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                      </div>
                      <div class="form-group checkbox-reset">
                        <label class="custom-checkbox mb-0">
                          <input type="checkbox" name="#"> <span class="checkmark"></span> Keep me signed in</label>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-submit full-width">Create your account</button>
                      </div>
                      <div class="form-group text-center"> <span>or</span>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-facebook full-width">
                          <img src={{ asset("website/assets/img/facebook-logo.svg") }} alt="btn logo">Continue with Facebook</button>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-second btn-google full-width">
                          <img src={{ asset("website/assets/img/google-logo.png") }} alt="btn logo">Continue with Google</button>
                      </div>
                      <div class="form-group text-center">
                        <p class="text-light-black mb-0">Have an account? <a href="login.html">Sign in</a>
                        </p>
                      </div> <span class="text-light-black fs-12 terms">By creating your Foodvia account, you agree to the <a href="#"> Terms of Use </a> and <a href="#"> Privacy Policy.</a></span>
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