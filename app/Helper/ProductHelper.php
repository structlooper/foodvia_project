<?php
namespace App\Helper;

use DB;

class ProductHelper
{
    /**
     * Healper to get data for selected Product
     * by Structlooper
     * @param $product_id
     * @return |null
     */
    public static function getProductImage($product_id)
    {
        if (!is_null($product_id)) {
            # code...
            return DB::table('product_images')
            ->where('product_id',$product_id)->first();
        }else{
            return null;
        }
    }
    public static function getProductPrice($product_id)
    {
        if (!is_null($product_id)) {
            # code...
            return DB::table('product_prices')
            ->where('product_id',$product_id)->first();
        }else{
            return null;
        }
    }

    /**
     * Healper to get data for selected cuisine's category
     * by Structlooper
     * @param $category_id
     * @return |null
     */
    public static function getCategoryImage($category_id)
    {
        if (!is_null($category_id)) {
            # code...
            return DB::table('category_images')
            ->where('category_id',$category_id)->first();
        }else{
            return null;
        }
    }

    /**
     * Healper to get cart product of current order
     * by Structlooper
     * @param $order_id
     * @return $cartProductDetails | null
     */
    public static function getCartProduct($order_id)
    {
        if (!is_null($order_id)) {
            # code...
            $cartProduct = DB::table('user_carts')
            ->where('order_id',$order_id)->get();
            $cartProductDetails = [];
            foreach ($cartProduct as  $value) {
                $product = DB::table('products')
                    ->join('user_carts','user_carts.product_id','=','products.id')
                    ->where('product_id',$value->product_id)
                    ->first();
                array_push($cartProductDetails,$product);
            }
            return $cartProductDetails;
        }else{
            return null;
        }

    }
}