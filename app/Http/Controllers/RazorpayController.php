<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                $update = DB::table('order_invoices')
                    ->where('order_id',$request->order_id)
                    ->update(['status' => 'success']);
                if ($update){
                    return redirect(route('order_details'))->with('message','Order placed successfully');
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
                }
            }
        }

        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}
