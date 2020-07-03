<?php

namespace App\Http\Controllers\Front;

use App\UserCart as user_cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;
class CartApiController extends Controller
{
    //
        public function add_to_cart(request $request)
        {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
                $product_id = $request->product_id;
                $note = $request->note;
                $shop_id = $request->shop_id;
                $checkIfDiffertShop = DB::table('user_carts')
                    ->where('user_id',$user_id)
                    ->where('order_id',null)
                    ->get();
                $cartProductShopIds = [];
                foreach ($checkIfDiffertShop as $value) {
                    array_push($cartProductShopIds,$value->shop_id);
                }
                if (sizeof($cartProductShopIds) > 0) {
                    if (in_array(strval($shop_id), $cartProductShopIds)) {
                        if (user_cart::where('product_id', '=', $product_id)
                                ->where('order_id', '=', null)
                                ->count() > 0) {
                            $get_count = user_cart::where('product_id', '=', $product_id)
                                ->where('user_id', '=', $user_id)
                                ->where('order_id', '=', null)
                                ->first();

                            $final_quantity = $get_count->quantity + 1;
                            $update_count = DB::table('user_carts')
                                ->where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->where('order_id', null)
                                ->update(['quantity' => $final_quantity]);
                            if ($update_count === 1) {
                                return [
                                    'status' => 4,
                                    'message' => 'Dish already present in cart Count added',
                                    'debug' => $update_count,
                                ];
                            }
                        } else {

                            $data = [
                                'user_id' => $user_id,
                                'product_id' => $product_id,
                                'note' => $note,
                                'quantity' => 1,
                                'created_at' => Carbon::now(),
                                'shop_id' => $shop_id,
                                'updated_at' => null,
                                'deleted_at' => null,
                            ];
                            $insert_to_cart = DB::table('user_carts')
                                ->insert($data);
                            if ($insert_to_cart) {
                                return [
                                    'status' => 1,
                                    'message' => 'added to cart',
                                    'data' => $data,

                                ];
                            } else {
                                return [
                                    'status' => 0,
                                    'message' => 'something went wrong please try to refresh page',
                                ];
                            }
                        }
                    }else{
                        return ['status' => 3 ,'message' => 'your cart is not empty please clear before adding product from different shop'];
                    }
                }else{
                    if (user_cart::where('product_id', '=', $product_id)
                            ->where('order_id', '=', null)
                            ->count() > 0) {
                        $get_count = user_cart::where('product_id', '=', $product_id)
                            ->where('user_id', '=', $user_id)
                            ->where('order_id', '=', null)
                            ->first();

                        $final_quantity = $get_count->quantity + 1;
                        $update_count = DB::table('user_carts')
                            ->where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->where('order_id', null)
                            ->update(['quantity' => $final_quantity]);
                        if ($update_count === 1) {
                            return [
                                'status' => 4,
                                'message' => 'Dish already present in cart Count added',
                                'debug' => $update_count,
                            ];
                        }
                    } else {

                        $data = [
                            'user_id' => $user_id,
                            'product_id' => $product_id,
                            'note' => $note,
                            'quantity' => 1,
                            'created_at' => Carbon::now(),
                            'shop_id' => $shop_id,
                            'updated_at' => null,
                            'deleted_at' => null,
                        ];
                        $insert_to_cart = DB::table('user_carts')
                            ->insert($data);
                        if ($insert_to_cart) {
                            return [
                                'status' => 1,
                                'message' => 'added to cart',
                                'data' => $data,

                            ];
                        } else {
                            return [
                                'status' => 0,
                                'message' => 'something went wrong please try to refresh page',
                            ];
                        }
                    }
                }
            }else{
                return [
                    'status' => 0,
                    'message' => 'Please login first to add item in cart',
                ];
            }


        }

        public function get_cart_data()
        {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
                try {

                    if (!is_null($user_id)) {
                        $cart_data = DB::table('user_carts')
                            ->join('products', 'products.id', '=', 'user_carts.product_id')
                            ->join('product_prices', 'product_prices.product_id', '=', 'user_carts.product_id')
                            ->where('user_id', $user_id)
                            ->where('order_id',null)
                            ->get();


                        if (!empty($cart_data)) {
                            $response = [
                                'status' => 1,
                                'message' => 'Data founded',
                                'data' => $cart_data,
                            ];
                        } else {
                            $response = [
                                'status' => 3,
                                'message' => 'Cart is empty',
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 2,
                            'message' => 'please login to get saved cart',
                        ];
                    }
                    return $response;

                } catch (Exception $e) {
                    return [
                        'status' => 0,
                        'message' => 'Something is went wrong',
                        'error' => trans('form.whoops')
                    ];
                }
            }
            else{
                return ['status' => 0, 'error' => 'please login'];
            }
        }

        public function increment_product(request $request,$product_id)
        {
            try {
                $user_id = Auth::user()->id;
                if (!is_null($user_id)) {
                    if (!is_null($product_id)) {
                        $get_count = user_cart::where('product_id', '=', $product_id)
                            ->where('user_id', '=', $user_id)
                            ->where('order_id','=',null)
                            ->first();

                        $final_quantity = $get_count->quantity + 1;
                        $update_count = DB::table('user_carts')
                            ->where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->where('order_id',null)
                            ->update(['quantity' => $final_quantity]);
                        if ($update_count === 1) {
                            $response = [
                                'status' => 1,
                                'message' => 'count increased',
                            ];
                        } else {
                            $response = [
                                'status' => 0,
                                'message' => 'something went wrong'
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 0,
                            'message' => 'please select a product'
                        ];
                    }
                }
                else{
                    $response = [
                        'status' => 2,
                        'message' => 'please login first',
                    ];
                }
                return $response;
            }
            catch (Exception $e){
                return [
                    'status' => 0,
                    'message' => 'Something is went wrong',
                    'error' => trans('form.whoops')
                ];
            }
        }




        public function decrement_product(request $request,$product_id)
        {
            try {
                $user_id = Auth::user()->id;
                if (!is_null($user_id)) {
                    if (!is_null($product_id)) {
                        $get_count = user_cart::where('product_id', '=', $product_id)
                            ->where('user_id', '=', $user_id)
                            ->where('order_id', '=', null)
                            ->first();
                        if ($get_count->quantity === 1)
                        {
                            $update_count = DB::table('user_carts')
                                ->where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->delete();
                            if ($update_count === 1){

                                return [
                                    'status' => 3,
                                    'message' => 'Dish removed from cart',
                                ];
                            }
                        }
                        $final_quantity = $get_count->quantity - 1;
                        $update_count = DB::table('user_carts')
                            ->where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->where('order_id',null)
                            ->update(['quantity' => $final_quantity]);
                        if ($update_count === 1) {
                            $response = [
                                'status' => 1,
                                'message' => 'count decreased',
                            ];
                        } else {
                            $response = [
                                'status' => 0,
                                'message' => 'something went wrong'
                            ];
                        }
                    } else {
                        $response = [
                            'status' => 0,
                            'message' => 'please select a product'
                        ];
                    }
                }
                else{
                    $response = [
                        'status' => 2,
                        'message' => 'please login first',
                    ];
                }
                return $response;
            }
            catch (Exception $e){
                return [
                    'status' => 0,
                    'message' => 'Something is went wrong',
                    'error' => trans('form.whoops')
                ];
            }
        }

        public function empty_cart()
        {
            try {


                $user_id = Auth::user()->id;
                if (!is_null($user_id)) {
                    $delete_all = DB::table('user_carts')
                        ->where('user_id', $user_id)
                        ->where('order_id',null)
                        ->where('promocode_id',null)
                        ->delete();
                    if ($delete_all == 0 ) {
                        $response = [
                            'status' => 0,
                            'message' => 'Cart is already empty please add item',
                        ];
                    } else {

                        $response = [
                            'status' => 1,
                            'message' => 'Cart Cleared'
                        ];

                    }
                } else {
                    $response = [
                        'status' => 2,
                        'message' => 'please login first to access cart'
                    ];
                }
                return $response;
            }
            catch (Exception $e){
                return [
                    'status' => 0,
                    'message' => 'something went wrong',
                    'error' => trans('form.whoops')
                ];
            }
        }
}
