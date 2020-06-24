<?php

namespace App\Http\Controllers\Front;


use App\Helper\ProductHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CheckOutController extends Controller
{
    //
    public function apply_promo(request $request)
    {
//        if (Auth::user()) {
//            try {
                $promo_code = $request->promo_code;

                $user_id = Auth::user()->id;

                $data_base_promo = DB::table('promocodes')
                    ->where('promo_code', $promo_code)
                    ->first();

//                print_r($data_base_promo->expiration);
//                exit;
                if (!is_null($data_base_promo)) {
                    $date = Carbon::now();
                    if ($data_base_promo->status == 'ADDED' and $data_base_promo->expiration > $date->toDateTimeString()) {

                        if ($data_base_promo->coupon_user_limit > 0) {

                            if ($data_base_promo->coupon_limit > 0) {
//                            print_r( 'coupn'.$data_base_promo->id);
//                            exit;
                                $promo_code_user = DB::table('promocode_usages')
                                    ->where('user_id', $user_id)
                                    ->where('promocode_id', $data_base_promo->id)
                                    ->first();
//                            print_r('not'.$promo_code_user);
//                            exit;
                                    if (is_null($promo_code_user)) {
                                        DB::table('promocode_usages')
                                            ->insert([
                                                'user_id' => $user_id,
                                                'promocode_id' => $data_base_promo->id,
                                                'status' => 'SELECTED',
                                                'created_at' => Carbon::now(),

                                            ]);
                                        return ['status' => 1, 'message' => 'Promo code applied successfully', 'data' => $data_base_promo];
                                    }
                                    elseif ($promo_code_user->status == 'USED') {
                                        return ['status' => 0, 'message' => 'You have already used this promo code'];
                                    } elseif ($promo_code_user->status == 'SELECTED') {
                                        DB::table('promocode_usages')
                                            ->where('user_id', $user_id)
                                            ->where('promocode_id', $data_base_promo->id)
                                            ->update([
                                                'status' => 'SELECTED',
                                                'updated_at' => Carbon::now(),

                                            ]);
                                        return ['status' => 1, 'message' => 'Promo code applied successfully', 'data' => $data_base_promo];
                                    } else {
                                        DB::table('promocode_usages')
                                            ->insert([
                                                'user_id' => $user_id,
                                                'promocode_id' => $data_base_promo->id,
                                                'status' => 'SELECTED',
                                                'created_at' => Carbon::now(),

                                            ]);
                                        return ['status' => 1, 'message' => 'Promo code applied successfully', 'data' => $data_base_promo];
                                    }

                            } else {
                                return ['status' => 0, 'message' => 'Promo Code limit is exceed!!'];
                            }
                        } else {
                            return ['status' => 0, 'message' => 'Promo Code User limit is exceed!!'];
                        }
                    } else {
                        return ['status' => 0, 'message' => 'Promo Code Expired!'];
                    }
                }

                else {
                    return ['status' => 0, 'message' => 'Entered Promo code is invalid'];
                }
//            }
//                catch ( Exception $e)
//                    {
//                        return ['status' => 0 , 'error' => 'some thing went wrong'];
//                    }
//        }
//        else{
//            return [ 'status'=>2,'error'=> 'Please login first'];
//        }
    }


    public function get_promo()
    {
        if (Auth::user()) {
            try {
                $user_id = Auth::user()->id;
                $promo_code_user = DB::table('promocode_usages')
                    ->where('user_id', $user_id)
                    ->first();

                                $promo_code_details = DB::table('promocodes')
                                    ->where('id',$promo_code_user->promocode_id)
                                    ->first();

                                if (is_null($promo_code_user)) {
                                    return ['status' => 0, 'message' => 'No selected promo code found'];
                                } elseif ($promo_code_user->status == 'SELECTED') {

                                    return ['status' => 1, 'message' => 'Applied Promo code found', 'info' => $promo_code_user, 'data' => $promo_code_details];
                                } else {

                                    return ['status' => 0, 'message' => 'No active promo code'];
                                }
                }
                catch ( Exception $e)
                    {
                        return ['status' => 0 , 'error' => 'some thing went wrong'];
                    }
        }
        else{
            return [ 'status'=>2,'error'=> 'Please login first'];
        }
    }


    public function place_order(request $request)
    {
        if (!is_null(Auth::user())) {
//
        $user_id = Auth::user()->id;
//        try {


            $cart_product = DB::table('user_carts')
                ->where('order_id',null)
                ->where('user_id', $user_id)
                ->get();

            if ($cart_product->count() > 0) {

                $shop_id = [];
                foreach ($cart_product as $key => $value) {
                    array_push($shop_id,$value->shop_id);
                }

                $address_id = $request->address_id;
                $promo_code_id = $request->promo_code_id ?: 0;
//                print_r($promo_code_id);
//                exit;

                $status = 'ORDERED';
                $newotp = rand(100000, 999999);
                $invoice_id = Uuid::uuid4()->toString();
                if ($request->has('delivery_date')) {

                    $delivery_date = $request->delivery_date;
                    if (Carbon::parse($delivery_date)->format('Y-m-d') . ' 00:00:00' == Carbon::today()) {
                        $schedule_status = 0;
                    } else {
                        $schedule_status = 1;
                    }

                } else {

                    $delivery_date = date('Y-m-d H:i');
                    $schedule_status = 0;
                }

                $data = [
                    'invoice_id' => $invoice_id,
                    'user_id' => $user_id,
                    'user_address_id' => $address_id,
                    'shop_id' => $shop_id[0],
                    'delivery_date' => $delivery_date,
                    'order_otp' => $newotp,
                    'status' => $status,
                    'schedule_status' => $schedule_status,
                    'route_key' => 1,

                ];
                if (!is_null($address_id)) {
                    $order_id = DB::table('orders')
                        ->insertGetId($data);
                    if (!is_null($order_id)) {
                        $products = DB::table('user_carts')
                            ->where('user_id', $user_id)
                            ->where('order_id',null)
                            ->get();
                        if (!is_null($promo_code_id)) {
//

                            $promocode_uses = DB::table('promocode_usages')
                                ->where('user_id', $user_id)
                                ->where('promocode_id', $promo_code_id)
                                ->first();
//                            print_r($promocode_uses->status);
//                            exit;
                            $discount = 0;
                            if (!is_null($promocode_uses)) {
//
                                if($promocode_uses->status === 'SELECTED'){
                                    $prmocode_details = DB::table('promocodes')
                                        ->where('id', $promocode_uses->promocode_id)
                                        ->first();

                                    $discount += $prmocode_details->discount;

                                }

                                elseif ($promocode_uses->status === 'USED') {
                                    return ['status' => 0, 'message' => 'promo code already used!'];
                                } else {
                                    $prmocode_details = DB::tables('promocodes')
                                        ->where('id', $promo_code_id)
                                        ->first();

                                    $discount += $prmocode_details->discount;

                                }
                            }else{
                                $discount += 0;

                            }


                        }
                        $quantity = 0;
                        $total_pay = 0;
                        foreach ($products as $key => $value) {
                            $quantity += $value->quantity;
                            $price_details = ProductHelper::getProductPrice($value->product_id);
                            $total_pay += $price_details->price * $value->quantity;

                        }

                        $status = 'pending';
                        $payment_mode = $request->payment_mode;

                        $data = [
                            'order_id' => $order_id,
                            'quantity' => $quantity,
                            'discount' => $discount,
                            'total_pay' => $total_pay,
                            'payment_mode' => $payment_mode,
                            'status' => $status,
                            'created_at' => Carbon::now(),

                        ];
                        $invoice_details = DB::table('order_invoices')
                            ->insert($data);

                        $order_product = DB::table('user_carts')
                            ->where('user_id',$user_id)
                            ->where('order_id',null)
                            ->update(['order_id' => $order_id , 'promocode_id' => $promo_code_id]);

                        if ($invoice_details) {
                            return [
                                'status' => 1,
                                'message' => 'Order placed successfully',
                                'data' => $data,

                            ];
                        } else {
                            return ['status' => 0, 'message' => 'something went wrong'];
                        }

                    } else {
                        return ['status' => 0, 'message' => 'Order not Taken'];
                    }
                } else {
                    return ['status' => 0, 'message' => 'Please select an address'];
                }

            } else {
                return [
                    'status' => 0,
                    'message' => 'Order cart is empty'
                ];
            }
//        }
//        catch(Exception $e){
//            return ['status' => 0];
//        }
        }else{ return ['status' => 0, 'message' => 'please login first!'];}
    }


    /*
     * FUNCTION AFTER CONFIRMATION OF ONLINE PAYMENT
     * :.@STRUCTLOOPR
     * */
    public function confirmation(request $request)
    {
        if (Auth::user()){
            $user_id = Auth::user()->id;
            $getPromoCode = DB::table('promocode_usages')
                ->where('user_id',$user_id)
                ->first();
//            print_r($getPromoCode);
//            exit;
            if (is_null($getPromoCode)){
                $promoCodeDetails = 0;
                $promocode_id = null;
            }elseif ($getPromoCode->status == 'SELECTED'){
                $promocode_id = $getPromoCode->promocode_id;
                $promoCodeDetails = DB::table('promocodes')
                    ->where('id',$promocode_id)
                    ->first();


            }else{
                $promoCodeDetails = 0;
                $promocode_id = null;
            }

            $getProductItems = DB::table('user_carts')
                ->where('user_id',$user_id)
                ->where('order_id',null)
                ->get();
            if ($getProductItems->count() > 0) {
                $shop_id = [];
                foreach ($getProductItems as $key => $value) {
                    array_push($shop_id,$value->shop_id);
                }
                $address_id = $request->address_id;
                if (!is_null($address_id)) {

//                    print_r($shop_id);
//                    exit;
                    $productItemDetails = [];
                    foreach ($getProductItems as $key => $value) {
                        $product = DB::table('products')
                            ->join('product_prices', 'product_prices.product_id', '=', 'products.id')
                            ->where('product_id', $value->product_id)
                            ->first();
                        array_push($productItemDetails, $product);
                    }
//                    $totalPrice = 0;
//                    foreach ($productItemDetails as $key => $value) {
//                        $totalPrice += $value->price;
//                    }
                    $quantity = 0;
                    $totalPrice = 0;
                    foreach ($getProductItems as $key => $value) {
                        $quantity += $value->quantity;
                        $price_details = ProductHelper::getProductPrice($value->product_id);
                        $totalPrice += $price_details->price * $value->quantity;

                    }

                    $discount = 0 ;
                    $grandPrice = 0;
                    if ($promoCodeDetails !== 0) {
                        if ($promoCodeDetails->promocode_type === 'percent') {
                            $typeOf = '%';
                            $grandPrice += ($promoCodeDetails->discount / 100) * $totalPrice;
                            $discount += $totalPrice - $grandPrice;
                        } else {
                            $typeOf = '₹';
                            $grandPrice += $totalPrice - $promoCodeDetails->discount;
                            $discount += $promoCodeDetails->discount;
                        }
                    } else {
                        $typeOf = '₹';
                        $grandPrice += $totalPrice;
                    }


                    $status = 'ORDERED';
                    $newotp = rand(100000, 999999);
                    $invoice_id = Uuid::uuid4()->toString();
                    if ($request->has('delivery_date')) {

                        $delivery_date = $request->delivery_date;
                        if (Carbon::parse($delivery_date)->format('Y-m-d') . ' 00:00:00' == Carbon::today()) {
                            $schedule_status = 0;
                        } else {
                            $schedule_status = 1;
                        }

                    } else {

                        $delivery_date = date('Y-m-d H:i');
                        $schedule_status = 0;
                    }
                    $dataOrder = [
                        'invoice_id' => $invoice_id,
                        'user_id' => $user_id,
                        'user_address_id' => $address_id,
                        'shop_id' => $shop_id[0],
                        'delivery_date' => $delivery_date,
                        'order_otp' => $newotp,
                        'status' => $status,
                        'schedule_status' => $schedule_status,
                        'route_key' => 1,

                    ];
                        $order_id = DB::table('orders')
                            ->insertGetId($dataOrder);
                        if (!is_null($order_id)) {
                            $products = DB::table('user_carts')
                                ->where('user_id', $user_id)
                                ->where('order_id',null)
                                ->get();



                            $status = 'pending';
                            $payment_mode = 'online';

                            $data = [
                                'order_id' => $order_id,
                                'quantity' => $quantity,
                                'discount' => $discount,
                                'total_pay' => $totalPrice,
                                'payable' => $grandPrice,
                                'payment_mode' => $payment_mode,
                                'status' => $status,
                                'created_at' => Carbon::now(),

                            ];
                            $invoice_details = DB::table('order_invoices')
                                ->insert($data);

                            $ordered_product = DB::table('user_carts')
                                ->where('user_id',$user_id)
                                ->where('order_id',null)
                                ->update(['order_id' => $order_id , 'promocode_id' => $promocode_id ?: null]);

                            if ($invoice_details) {
                                DB::table('promocode_usages')
                                    ->where('user_id',$user_id)
                                    ->where('promocode_id',$promocode_id ?: null)
                                    ->update(['status' => 'USED']);


                                $data = [

                                    'product_details' => $productItemDetails,
                                    'promode_details' => $promoCodeDetails,
                                    'total_price' => $totalPrice,
                                    'grand_price' => $grandPrice,
                                    'type_of' => $typeOf ?: null,
                                    'order_id' => $order_id,
                                    'invoice_id' => $invoice_id,
                                ];
                                return view('website.confirm_payment')->with($data);
                            } else {
                                return back()->with('error','something went wrong');
                            }

                        } else {
                            return back()->with('error','order not taken internal error');
                        }

//            print_r($promoCodeDetails);

                }else{ return back()->with('error','please select address');}
            }else{ return back()->with('error','Cart is empty!!');}
        }else{
            return back()->with('error','Please login first!');
        }
    }
}
