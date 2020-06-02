<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index()
    {
        return view('website.index');
    }
    public function about()
    {
        return view('website.about');
    }

    public function add_restaurant()
    {
        return view('website.add_restaurant');
    }
    public function login()
    {
        return view('website.login');
    }
    public function register()
    {
        return view('website.register');
    }
    public function checkout()
    {
        return view('website.checkout');
    }
    public function order_details()
    {
        return view('website.order_details');
    }
}