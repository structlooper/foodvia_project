<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;
use DB;

class RazorpayController extends Controller
{


    public function payment(request $request)
    {
        //Input items of form
        $input = Input::all();
        //get API Configuration
        $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
            // Do something here for store payment details in database...

            if ($response->status === 'captured'){
                DB::table('orders')
                    ->where('id',$request->order_id)
                    ->update(['status' => 'ORDERED']);
                $update = DB::table('order_invoices')
                    ->where('order_id',$request->order_id)
                    ->update(['status' => 'success']);
                if ($update){
                    DB::table('user_carts')
                        ->where('user_id', Auth::user()->id)
                        ->where('order_id', null)
                        ->update(['order_id' => $request->order_id]);

                    return redirect(route('order_details'))->with('flash_success','Order placed successfully');
                }
            }else{
                $update = DB::table('order_invoices')
                    ->where('order_id',$request->order_id)
                    ->update(['status' => 'failed']);

                if ($update){
                    return [
                        'status' => 0,
                        'message' => 'payment Failure',
                    ];
                }else{
                    return [
                        'status' => 0,
                        'message' => 'internal server error please contact service provider'
                    ];
                }
            }
        }

        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}
