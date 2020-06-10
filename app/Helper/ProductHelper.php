<?php
namespace App\Helper;

use DB;

class ProductHelper
{
    /**
     * Healper to get data for selected Product
     * by Structlooper
     */
    public static function getProductImage($product_id)
    {
        if (!is_null($product_id)) {
            # code...
            $product_image = DB::table('product_images')
            ->where('product_id',$product_id)->first();
            return $product_image;
        }else{
            return null;
        }
    }
    public static function getProductPrice($product_id)
    {
        if (!is_null($product_id)) {
            # code...
            $product_price = DB::table('product_prices')
            ->where('product_id',$product_id)->first();
            return $product_price;
        }else{
            return null;
        }
    }
     /**
     * Healper to get data for selected cuisine's category
     * by Structlooper
     */
    public static function getCategoryImage($category_id)
    {
        if (!is_null($category_id)) {
            # code...
            $category_image = DB::table('category_images')
            ->where('category_id',$category_id)->first();
            return $category_image;
        }else{
            return null;
        }
    }
}