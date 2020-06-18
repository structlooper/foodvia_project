<?php

namespace App\Http\Controllers\Front;

use App\Helper\ProductHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

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
}
