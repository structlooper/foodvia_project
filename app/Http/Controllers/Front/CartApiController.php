<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartApiController extends Controller
{
    //
        public function add_to_cart(request $request)
        {
//            $user_id = 1;
            $product_id = $request->product_id;
            $count = $request->count;
//            if (!is_null($user_id))
//            {
//                $response = [
//                  'status' => 0,
//                  'message' => 'Please login first',
//                ];
//            }
//            else{
                $data = [
//                    'user_cart_id' => $user_id,
                    'addon_product_id' => $product_id,
                    'quantity' => $count,
                    'created_at'=> Carbon::now(),
                    'updated_at'=>null,
                    'deleted_at' =>null,
                ];
                $insert_to_cart = DB::table('cart_addons')
                    ->insert($data);
                if ($insert_to_cart)
                {
                    $response = [
                        'status' => 1,
                        'message' => 'added to cart successfully',
                        'data' => $data,

                    ];
                }
                else{
                    $response = [
                        'status' => 0,
                        'message' => 'something went wrong please try to refresh page',
                    ];
                }
//            }
            return $response;

        }

}
