<?php

namespace App\Http\Controllers\Front;

use App\Shop;
use DB;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Illuminate\Http\Request;
use App\Helper\ProductHelper;
use App\Http\Controllers\Controller;
use Session;

class WebController extends Controller
{
    public function index()
    {
//        $shop_id = 1;
//        $categories = DB::table('categories')
//        ->where('shop_id',$shop_id)
//        ->join('category_images','category_images.category_id', '=' , 'categories.id')
//        ->get();
       
        $cuisine = DB::table('cuisines')->get();
//        $product = DB::table('products')
//        ->where('shop_id',$shop_id)
//        ->join('product_images','product_images.product_id','=',"products.id")
//        ->join('product_prices','product_prices.product_id','=',"products.id")
//        ->get();
        $shops = Shop::orderByRaw('RAND()')->take(10)->get();

        $data= [
            // 'categories' => $categories,
            // 'product' => $product,
            'cuisine' => $cuisine,
            'shops' => $shops,


        ];
        
        return view('website.index')->with($data);
    }


    /**
     * categories of shops according to cuisine 
     * @structlooper
     */
    public function categories($id)
    {
        $cuisine = DB::table('cuisines')->get();
        $filtered_shops_id = DB::table('cuisine_shop')
        ->where('cuisine_id',$id)->get();
        
        $cuisine_data = DB::table('cuisines')
        ->where('id',$id)->first();
        $final_shops_data = [];
        foreach ($filtered_shops_id as  $one_id) {
            # code...
            $filtered_shops_data = DB::table('shops')
            ->where('id',$one_id->shop_id)
            ->get();
            array_push($final_shops_data,$filtered_shops_data);
        }
        if(sizeof($final_shops_data) != 0)
        {
            shuffle($final_shops_data);
            $data = [
                'final_shops_data' => $final_shops_data,
                'cuisine' => $cuisine,
                'cuisine_data' => $cuisine_data,
            ];
            return view('website.filtered_shops')->with($data);
        }
        else{
            return back()->with('status','no data found');
        }
    }

    public function categories_product($cuisine_id,$shop_id)
    {
        // shop details
        $shop_data = DB::table('shops')
        ->where('id',$shop_id)->first();

        
        
        if (!is_null($shop_data)) {
            // categories in selected shop
            $categories = DB::table('categories')
            ->where('shop_id',$shop_id)
            ->get();

            

            // product by pre selected category
            $category_prduct = DB::table('category_product')
            ->where('category_id',$cuisine_id)
            ->get();
            $product_details = [];
            foreach ($category_prduct as $value) {
                # code...
                $product_data = DB::table('products')
                ->where('id', $value->product_id)
                ->get();
                
                array_push($product_details, $product_data);
            }
            // var_dump($product_detalis);
            // exit;

            if (count($product_details) > 0) {
                # code...
                
                $data = [
                    'shop_data' =>$shop_data,
                    'categories' => $categories,
                    'product_details' => $product_details,
                ];
                return view('website.selected_restro')->with($data);
            }
            else{
                return back()->with('error','no data found');
            }
        }
        else{
            return back()->with('error','no data found');
        }
        // print_r($shop_data );
        // exit;
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
        if (Auth::user()){
            return redirect(route('home'));
        }else{
            return view('website.login');
        }
    }
    public function register()
    {

        if (Auth::user()){
            return redirect(route('home'));
        }else {
            return view('website.register');
        }
    }
    public function checkout(request $request)
    {

        if (Auth::user()){
            $user_address = DB::table('user_addresses')
                ->where('user_id',Auth::user()->id)
                ->get();
            return view('website.checkout')->with('user_address',$user_address);

            return redirect(route('home'));
        }else {
            return view('website.login');
        }



    }
    public function order_details()
    {
        if (Auth::user()){
            $orderDetails = DB::table('orders')
                ->where('user_id',Auth::user()->id)
                ->get();

            $orders = [];
            foreach ($orderDetails as $value) {
                $orderInvoice = DB::table('orders')
                    ->join('order_invoices', 'order_invoices.order_id', '=', 'orders.id')
                    ->join('shops','shops.id','=','orders.shop_id')
                    ->join('user_addresses','user_addresses.id','=','orders.user_address_id')
                    ->where('order_id', $value->id)
                    ->select('order_invoices.*',
                        'orders.invoice_id','orders.status'
                        , 'shops.name','shops.address','shops.estimated_delivery_time',
                            'user_addresses.building','user_addresses.street','user_addresses.city','user_addresses.state','user_addresses.country','user_addresses.pincode','user_addresses.landmark','user_addresses.type')
                    ->get();
                    array_push($orders, $orderInvoice);


            }

//            print_r($orders);
//            exit;
            $data = [
                'orders' => $orders,
            ];

            return view('website.order_details')->with($data);

        }else{
            return redirect(Route('web_login'))->with('error','please login first!');
        }
    }
    public function user_profile()
    {
        if (Auth::user()){
            $user_address = DB::table('user_addresses')
                ->where('user_id',Auth::user()->id)
                ->get();
//        print_r($user_address);
            return view('website.user_profile')->with('user_address',$user_address);

        }else{
            return redirect(route('web_login'));
        }

    }

    public function restaurant($shop_id){
        $selectedRestroDetail = DB::table('shops')
            ->where('id',$shop_id)
            ->first();




//        $cuisine_shopDetails = [];
//        foreach ($cuisine_shop as $key => $value) {
//            $cuisine_shopDetail = DB::table('cuisines')
//                ->where('id',$value->cuisine_id)
//                ->get();
//            array_push($cuisine_shopDetails,$cuisine_shopDetail);
//        }


        if (!is_null($selectedRestroDetail)){
            $categories = DB::table('categories')
                ->where('shop_id',$shop_id)
                ->get();
            $one_categories = DB::table('categories')
                ->where('shop_id',$shop_id)
                ->first();

            $category_products = [];
            $category_product = DB::table('category_product')
                ->where('category_id',$one_categories->id)
                ->get();
            array_push($category_products,$category_product);


            $productDetails = [];
                foreach ($category_product as $item) {
                    $productDetail = DB::table('products')
                        ->where('id',$item->product_id)
                        ->get();
                    array_push($productDetails,$productDetail);
                }

            $data = [
                'shop_data' => $selectedRestroDetail,
                'categories' => $categories,
                'productDetails' => $productDetails,
                'one_categories' => $one_categories,

            ];
            return view('website.restaurant_specific')->with($data);
        }else{
            return back()->with('error','No restaurant found');
        }


    }

    public function all_restro(){
        $cuisine = DB::table('cuisines')->get();
        $shops = DB::table('shops')->get();
        $data= [

            'cuisine' => $cuisine,
            'shops' => $shops,
        ];
        return view('website.all_restro')->with($data);

    }
}