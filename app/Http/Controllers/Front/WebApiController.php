<?php

namespace App\Http\Controllers\Front;

use App\Helper\ProductHelper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WebApiController extends Controller
{
    //
    public function index()
    {
        return 'hello world';
    }
    public function categories()
    {
        $data = DB::table('categories')
        ->join('category_images','category_images.category_id', '=' , 'categories.id')
        ->get();
        if ($data) {
            # code...
            return ['status' => 1,'message' => 'Data found successfully', 'data' => $data ];
        }
    }
    public function product_category(request $request,$category_id)
    {

        $category_product = DB::table('category_product')
        ->where('category_id',$category_id)
        ->get();
        // return $category_product;
        $product_details = [];
        foreach ($category_product as $value) {
            $product_data = DB::table('products')
                ->join('product_images', 'product_images.product_id' , '=' , 'products.id')
                ->join('product_prices', 'product_prices.product_id' , '=' , 'products.id')
                ->where('products.id', $value->product_id)
                ->get();
            array_push($product_details, $product_data);


        }

        if (is_null($product_details)) {
            
            
            $response = [
                'status' => 0,
                'message' => 'data not found',
                'data' => [],
            ];
        }
        else{
            $response = [
                'status' => 1,
                'message' => 'Data found',
                'category' => $category_id,
                'data' => $product_details,
            ];
            
        }
        return $response;
    }
    public function login(request $request)
    {
        if (!is_null($request->phoneNumber) and !is_null($request->password)) {
            $user = DB::table('users')
                ->where('phone', $request->phoneNumber)
                ->first();
            if (!is_null($user)) {
                //test for password and like so
                if (!Hash::check($request->password, $user->password)) {
                    // wrong password
                    return ['status' => 0,'message' => 'Entered password is incorrect'];
                }else {
                    if (Auth::attempt(['phone' => $request->phoneNumber, 'password' => $request->password],true)) {
                        $request->session()->regenerate();
                        return [
                            'status' => 1,
                            'message' => 'user logged in success',
                            'data' => Auth::user()
                        ];

                    } else {
                        return [
                            'status' => 0,
                            'message' => 'something went wrong',
                        ];
                    }

                }
            } else {
                return [
                    'status' => 0,
                    'message' => 'Entered record not found'
                ];
            }
        }else {
            return [
                'status' => 0,
                'message' => 'Please enter both phone number and password'
            ];
        }
    }

    public function search_product(request $request){
        if ($request->has('productName')) {
            $cuisineName = $request->productName;
            $cusineIfPresent = DB::table('cuisines')
                ->where('name',$cuisineName)
                ->first();
            if (!is_null($cusineIfPresent)){
                return [ 'status' => 1, 'message' => 'founded', 'data' => $cusineIfPresent];
            }else{
                return [ 'status' => 0 , 'message' => $cuisineName . ' is not available in your area'];
            }
            }else{
            return [ 'status' => 0 , 'message' => 'please enter product name' ];
        }
    }

}
