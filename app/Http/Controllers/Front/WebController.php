<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Setting;
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

        $cuisine = [];

        $shops = [];
        if (Session::has('latitude') and Session::has('longitude'))
        {
            $longitude = Session::get('longitude');
            $latitude = Session::get('latitude');
            if (Setting::get('search_distance') > 0) {
                $distance = Setting::get('search_distance');

                $filtered_shops_data = Shop::select('shops.*')
                    ->selectRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) AS distance")
                    ->whereRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) <= $distance")
                    ->orderByRaw('RAND()')->take(10)->get();

                array_push($shops, $filtered_shops_data);

                $cuisines = [];
                foreach ($filtered_shops_data as $value) {
                    $cusi = DB::table('cuisine_shop')
                        ->where('shop_id', $value->id)
                        ->get();
                    array_push($cuisines, $cusi);
                }


                $currentId = [];
                foreach ($cuisines as $value) {
                    foreach ($value as $item) {
                        $cuisineDetails = DB::table('cuisines')
                            ->where('id', $item->cuisine_id)
                            ->get();
                        if (in_array(strval($item->cuisine_id), $currentId)) {
                            continue;
                        } else {
                            array_push($cuisine, $cuisineDetails);
                        }
                        array_push($currentId, strval($item->cuisine_id));
                    }
                }


            }
        }else {
            $filtered_shops_data = DB::table('shops')
                 ->orderByRaw('RAND()')->take(10)->get();
            array_push($shops, $filtered_shops_data);

            $cuisine_1 = DB::table('cuisines')->get();
            array_push($cuisine, $cuisine_1);

        }

        $data= [

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
            if (Session::has('latitude') and Session::has('longitude'))
            {
                $longitude = Session::get('longitude');
                $latitude = Session::get('latitude');
                if (Setting::get('search_distance') > 0) {
                    $distance = Setting::get('search_distance');

                    $filtered_shops_data = Shop::select('shops.*')
                        ->selectRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) AS distance")
                        ->whereRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) <= $distance")
                        ->where('id', '=' , $one_id->shop_id)
                        ->get();
                    array_push($final_shops_data, $filtered_shops_data);
                }
            }else {
                $filtered_shops_data = DB::table('shops')
                    ->where('id', $one_id->shop_id)
                    ->get();
                array_push($final_shops_data, $filtered_shops_data);
            }
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
                            'user_addresses.building','user_addresses.street','user_addresses.map_address','user_addresses.pincode','user_addresses.landmark','user_addresses.type')
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
            $one_category = DB::table('categories')
                ->where('shop_id',$shop_id)
                ->first();

            if (!is_null($one_category)) {
                $category_products = [];
                $category_product = DB::table('category_product')
                    ->where('category_id', $one_category->id)
                    ->get();
                array_push($category_products, $category_product);


                $productDetails = [];
                foreach ($category_product as $item) {
                    $productDetail = DB::table('products')
                        ->where('id', $item->product_id)
                        ->get();
                    array_push($productDetails, $productDetail);
                }
            }else{
                $productDetails = [];
            }

            $data = [
                'shop_data' => $selectedRestroDetail,
                'categories' => $categories,
                'productDetails' => $productDetails,
                'one_categories' => $one_category,

            ];
            return view('website.restaurant_specific')->with($data);
        }else{
            return back()->with('error','No restaurant found');
        }


    }

    public function all_restro(){
        $cuisineWithDetails = [];
        if (Session::has('latitude') and Session::has('longitude'))
        {
            $longitude = Session::get('longitude');
            $latitude = Session::get('latitude');

            if (Setting::get('search_distance') > 0) {
                $distance = Setting::get('search_distance');

                $shops = Shop::select('shops.*')
                    ->selectRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) AS distance")
                    ->whereRaw("(6371 * acos( cos( radians('$latitude') ) * cos( radians(shops.latitude) ) * cos( radians(shops.longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(shops.latitude) ) ) ) <= $distance")
                    ->get();

                $cuisines = [];
                foreach ($shops as $value) {
                    $cuisine = DB::table('cuisine_shop')
                        ->where('shop_id', $value->id)
                        ->get();
                    array_push($cuisines, $cuisine);
                }


                $currentId = [];
                foreach ($cuisines as $value) {
                    foreach ($value as $item) {
                        $cuisineDetails = DB::table('cuisines')
                            ->where('id', $item->cuisine_id)
                            ->get();
                        if (in_array(strval($item->cuisine_id), $currentId)) {
                            continue;
                        } else {
                            array_push($cuisineWithDetails, $cuisineDetails);
                        }
                        array_push($currentId, strval($item->cuisine_id));
                    }
                }

            }
        }else{
            $shops = DB::table('shops')->get();
            $cuisineDetails = DB::table('cuisines')->get();
            foreach ($cuisineDetails as $key => $value) {
                array_push($cuisineWithDetails,$cuisineDetails);
            }


        }
        $data= [

            'cuisine' => $cuisineWithDetails,
            'shops' => $shops,
        ];
        return view('website.all_restro')->with($data);

    }
    public function profile_update(request $request){
        if (Auth::user()){
            $user_name = $request->user_name;
            $email = $request->user_email;
            if($request->has('user_image')){
                $file = $request->file('user_image');
                $extension = $file->getClientOriginalExtension();
                $image_name =  $user_name . '.' . $extension;
                $file->move(public_path().'public/images/user/', $image_name);
                $user_image = 'public/images/user/'.$image_name;
            }
            else{
                $user_image = 'N/A';
            }
            $updateUserProfile = DB::table('users')
                ->where('id',Auth::user()->id)
                ->update([
                    'name' => $user_name,
                    'email' => $email,
                    'avatar' => $user_image,
                ]);
            if ($updateUserProfile){
                return back()->with('flash_success','profile updated successfully');
            }else{
                return back()->with('error','something went wrong please try after some times');
            }

        }else{
            return back()->with('error','please login first');

        }
    }

    public function add_address_page(){
        return view('website.add_address_page');
    }
    public function add_new_address(request $request)
    {
        $validator = Validator::make(
            Input::only(['type', 'building', 'latitude', 'longitude', 'search_loc', 'pin_code'])
            , [
            'type' => 'required',
            'building' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'search_loc' => 'required',
            'pin_code' => 'required',
        ], [
            'required' => 'this field is required',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'please fill all required fields');
        }
        $building = $request->building;
        $type = $request->type;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $search_loc = $request->search_loc;
        $pin_code = $request->pin_code;
        if ($request->has('street')) {
            $street = $request->street;
        }else{
            $street= null;
        }
        if ($request->has('landmark')) {
            $landmark = $request->landmark;
        }else{
            $landmark= null;
        }

        $add_address = DB::table('user_addresses')
            ->insert([
               'user_id' => Auth::user()->id,
                'building' => $building,
                'street' => $street,
                'pincode' => $pin_code,
                'landmark' => $landmark,
                'map_address' => $search_loc,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'type' => $type,
            ]);
        if ($add_address){
            return redirect(Route('user_profile'))->with('flash_success','address saved successfully');
        }
        else{
            return redirect(Route('user_profile'))->with('flash_failure','address not saved');

        }
    }

    public function delete_user_address(request $request){
        if ($request->has('delete_id')){
            $del_id = $request->delete_id;
            $delete_address = DB::table('user_addresses')
                ->where('user_id',Auth::user()->id)
                ->where('id',$del_id)
                ->delete();
            if($delete_address){
                return back()->with('flash_success','address deleted successfully');
            }
        }else{
            return back()->with('error','some thing went wrong');
        }
    }
}