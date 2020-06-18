<?php

namespace App\Http\Controllers\Front;

use DB;
use Illuminate\Support\Facades\Auth;
use stdClass;
use Illuminate\Http\Request;
use App\Helper\ProductHelper;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function index()
    {
        $shop_id = 1;
        $categories = DB::table('categories')
        ->where('shop_id',$shop_id)
        ->join('category_images','category_images.category_id', '=' , 'categories.id')
        ->get();
       
        $cuisine = DB::table('cuisines')->get();
        $product = DB::table('products')
        ->where('shop_id',$shop_id)
        ->join('product_images','product_images.product_id','=',"products.id")
        ->join('product_prices','product_prices.product_id','=',"products.id")
        ->get();

        $shops = DB::table('shops')->get();
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
        if(!is_null($final_shops_data))
        {
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

            if (!is_null($product_details)) {
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