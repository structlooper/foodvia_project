<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//abort(404, 'The resource you are looking for could not be found');


Route::get('/test', 'WelcomeController@home');
Route::get('/', 'Front\WebController@index');

/**
 * new front of web
 * @structlooper
 *
 */

Route::group(['namespace' => 'Front', 'prefix' => 'web'], function () {
    Route::get('/','WebController@index')->name('home');
    Route::get('about', 'WebController@about')->name('about');
    Route::get('add_restaurant','WebController@add_restaurant')->name('add_restaurant');
    Route::get('login','WebController@login')->name('web_login');
    Route::get('register','WebController@register')->name('web_register');

    Route::group(['middleware' => 'CheckIfAuth'], function () {

        Route::get('checkout','WebController@checkout')->name('web_checkout');
        Route::get('order_details','WebController@order_details')->name('order_details');
        Route::get('user_profile','WebController@user_profile')->name('user_profile');


    });

    Route::get('category/{id}','WebController@categories')->name('category');
    Route::get('category/{id}/{it}','WebController@categories_product')->name('categories');

    Route::post('pay_online','CheckOutController@confirmation')->name('pay_online');
});
/**
 * Api routes for new front
 * @structlooper
 * 
 */
Route::group(['prefix' => 'api', 'namespace' => 'Front'], function () {

    Route::get('categories','WebApiCOntroller@categories');
    Route::get('product_category/{id}','WebApiController@product_category');

    /*
     * cart APIs routes
     * @structlooper
     * */
    Route::post('add_to_cart','CartApiController@add_to_cart');
    Route::get('get_cart_data','CartApiController@get_cart_data');
    Route::get('increment/{id}','CartApiController@increment_product');
    Route::get('decrement/{id}','CartApiController@decrement_product');
    Route::post('empty_cart','CartApiController@empty_cart');

/*
 * Auth routes for user login register pages
 * @structlooper
 * */
    Route::post('user_login','UserController@login');
    Route::post('user_register','UserController@register');

    Route::post('apply_promo','CheckOutController@apply_promo');
    Route::get('get_promo','CheckOutController@get_promo');
    Route::post('place_order','CheckOutController@place_order');


});
/*
 * razorpay payment routes
 * @structlooper
 * */
// Post Route For Makw Payment Request
Route::post('payment', 'RazorpayController@payment')->name('payment');




Route::get('privacy', function () {
    $page = 'privacy';
    $title = 'Privacy Policy';
    return view('static', compact('page', 'title'));
});

Route::get('aboutus', function () {
    $page = 'about';
    $title = 'About Us';
    return view('static', compact('page', 'title'));
});

Route::get('terms', function () {
    $page = 'terms';
    $title = 'Terms And Condition';
    return view('static', compact('page', 'title'));
});


// Route::get('faq', function () {
//     $page = 'faq';
//     $title = 'FAQ';
//     return view('static', compact('page', 'title'));
// });


Route::get('contact', function () {
    $page = 'contact';
    $title = 'Contact Us';
    return view('static', compact('page', 'title'));
});

Route::get('help', function () {
    $page = 'help';
    $title = 'Help';
    return view('static', compact('page', 'title'));
});

Route::get('refund', function () {
    $page = 'refund';
    $title = 'Refund';
    return view('static', compact('page', 'title'));
});

Route::get('otherterms', function () {
    $page = 'otherterms';
    $title = 'Other Terms';
    return view('static', compact('page', 'title'));
});


/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/search','WelcomeController@search');
Route::get('/enquiry-delivery','UserController@delivery');
Route::post('/enquiry-delivery','UserController@delivery_store');


Route::get('auth/facebook', 'SocialLoginController@redirectToFaceBook');
Route::get('auth/facebook/callback', 'SocialLoginController@handleFacebookCallback');
Route::get('auth/google', 'SocialLoginController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialLoginController@handleGoogleCallback');

Route::post('/social/login','SocialLoginController@loginWithSocial');

Route::get('/pushnotification', function () {
    $message = PushNotification::Message("Push Remote Rich Notifications",
        array(
            'badge' => 1,
            'sound' => 'example.aif',
            'content-available' => 1,
            'media-url' => 'https://i.imgur.com/t4WGJQx.jpg',
            'actionLocKey' => 'Action button title!',
            'locKey' => 'localized key',
            'locArgs' => array(
                'localized args',
                'localized args',
            ),
            'launchImage' => 'image.jpg',
            
            'custom' => array("custom data"=>array('we'=>1), "mutable-content" => 1,
                 "attachment-url"=> "https://raw.githubusercontent.com/Sweefties/iOS10-NewAPI-UserNotifications-Example/master/source/iOS10-NewAPI-UserNotifications-Example.jpg",
                "media-url" => "https://i.imgur.com/t4WGJQx.jpg" )
        )
    );   


    if(Request::has('andriod')){
    $test1 = \PushNotification::app('AndroidUser')
                ->to(Request::get('andriod'))
                ->send($message);
                dd($test1);
    }
    if(Request::has('iosuser')){
     $test = \PushNotification::app('IOSUser')
                ->to(Request::get('iosuser'))
                ->send($message);
                
                dd($test);
    }
    if(Request::has('iosprovider')){
    $test = \PushNotification::app('IOSProvider')
                ->to(Request::get('iosprovider'))
                ->send($message);
                dd($test);
    }
 });

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminAuth\LoginController@showLoginForm');
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', 'ShopAuth\LoginController@showLoginForm');
    Route::get('/login', 'ShopAuth\LoginController@showLoginForm');
    Route::post('/login', 'ShopAuth\LoginController@login');
    Route::post('/logout', 'ShopAuth\LoginController@logout');

    Route::get('/register', 'ShopAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'ShopAuth\RegisterController@register');

    Route::post('/password/email', 'ShopAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'ShopAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'ShopAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'ShopAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'transporter'], function () {
    Route::get('/login', 'TransporterAuth\LoginController@showLoginForm');
    Route::post('/login', 'TransporterAuth\LoginController@login');
    Route::post('/userlogin', 'TransporterAuth\LoginController@UserLogin');
    Route::get('/otplogin', 'TransporterAuth\LoginController@OtpLogin');
    Route::post('/logout', 'TransporterAuth\LoginController@logout');

    Route::post('/otp', 'TransporterAuth\RegisterController@OTP');
    Route::post('/verifyotp', 'TransporterAuth\RegisterController@CheckOtp');

    Route::get('/register', 'TransporterAuth\RegisterController@showRegistrationForm');
    Route::post('/register', 'TransporterAuth\RegisterController@register');

    Route::post('/password/email', 'TransporterAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'TransporterAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'TransporterAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'TransporterAuth\ResetPasswordController@showResetForm');

    Route::get('/home', 'TransporterController@index');
});

    Auth::routes();
    Route::get('login',function(){
        return redirect('/');
    });
    Route::post('login', 'Auth\LoginController@login')->name('login');

    Route::get('register',function(){
        return redirect('/');
    });
    Route::get('/home', 'UserController@showhome');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/user/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

    Route::post('register', 'Auth\RegisterController@register')->name('register');
    Route::post('shopreg', 'ShopController@register')->name('register');
    Route::post('newsletter', 'WelcomeController@newsletter')->name('newsletter');

    Route::post('/otp', 'Auth\RegisterController@OTP');
    Route::get('/dashboard', 'UserResource\OrderResource@orderprogress');
    Route::get('/profile', 'UserResource\ProfileController@index');
    Route::post('/profile', 'UserResource\ProfileController@update');
    Route::get('/changepassword', 'UserResource\ProfileController@changepassword');
    Route::post('/setpassword', 'UserResource\ProfileController@password');
    Route::resource('orders', 'UserResource\OrderResource');
    Route::resource('useraddress', 'UserResource\AddressResource');
    Route::get('/restaurants', 'UserResource\SearchResource@index')->name('restaurants');
    Route::get('/restaurant/details', 'UserResource\SearchResource@show');
    Route::post('mycart', 'UserResource\CartResource@addToCart');
    Route::post('addcart', 'UserResource\CartResource@store');
    Route::get('/clear/cart','UserResource\CartResource@clearCart');
    Route::get('/track/order/{id}','UserResource\SearchResource@ordertrack');
    Route::get('/product/details/{productid}/{cartId}/{shopname}/{productname}','UserResource\SearchResource@productDetails');
    // card
    Route::resource('card', 'Resource\CardResource');
    Route::get('payment', 'UserController@payment');
    Route::post('payment/confirm', 'PaymentController@payment');
    Route::any('cart/payment', 'UserController@order_payment');
    Route::get('wallet', 'UserController@wallet');
    Route::post('wallet', 'PaymentController@add_money');
    Route::post('/rating', 'UserResource\OrderResource@rate_review');
    Route::get('user/chat', 'UserResource\OrderResource@chatWithUser');
    Route::get('addons/{id}', 'Resource\ProductResource@show');
    Route::get('checkRipplePayment','PaymentController@checkRipplePayment');
    Route::get('checkEtherPayment','PaymentController@checkEtherPayment');
    // swiggy design
    Route::get('payments', 'UserController@payment');
    Route::resource('favourite', 'Resource\FavoriteResource');
    Route::get('offers', 'UserResource\SearchResource@offers');
    Route::get('legal', 'UserResource\SearchResource@legal');
    Route::get('faq', 'UserResource\SearchResource@faq');
    Route::get('queries', 'UserResource\SearchResource@queries');
    Route::post('wallet/promocode', 'UserResource\WalletResource@store');
    Route::post('/reorder', 'UserResource\OrderResource@reorder');
    
    //Route::get('/token','BraintreeTokenController@token');
    //Route::get('/payment','BraintreeTokenController@payment');
   // Route::post('/payment','BraintreeTokenController@do_payment');
  /*  Route::get('faq','WelcomeController@faq');
    Route::get('aboutus','WelcomeController@aboutus');
    Route::get('termcondition','WelcomeController@termcondition');*/
