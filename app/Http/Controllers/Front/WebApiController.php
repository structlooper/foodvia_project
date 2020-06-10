<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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
            $response = ['status' => 1,'message' => 'Data found succesfully', 'data' => $data ];
            return $response;
        }
    }
    public function product_category(request $request,$id)
    {
        $category_id = $id;
        $category_prduct = DB::table('category_product')
        ->where('category_id',$category_id)
        ->get();
        // return $category_prduct;
        $product_detalis = [];
        foreach ($category_prduct as $value) {
            # code...
            $product_data = DB::table('products')
            ->where('id', $value->product_id)
            ->get();

            array_push($product_detalis, $product_data);
        }
        

        if (is_null($product_detalis)) {
            
            
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
                'data' => $product_detalis,
            ];
            
        }
        return $response;
    }
}
