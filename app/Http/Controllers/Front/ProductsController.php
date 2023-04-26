<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Cast\String_;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                // Getting Category Details
                $categoryDetails = Category::categoryDetails($url);
                // dd($categoryDetails);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // Checking for Dynamic Filters
                $productFilters = ProductsFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    # If filter is selected
                    if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) 
                    && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])){
                        $categoryProducts->whereIn($filter['filter_column'],$data[$filter['filter_column']]);
                    }
                }
                
                // Checking for Sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product_latest") {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price_lowest") {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price_highest") {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    }
                }

                // Checking for Size
                if (isset($data['size']) && !empty($data['size'])) {
                    $productIds = ProductsAttribute::select('product_id')->whereIn('size',$data['size'])->pluck('product_id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }
                
                // Checking for Color
                if (isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color',$data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }

                // Checking for Price (Old Version)
                // if (isset($data['price']) && !empty($data['price'])) {
                //     // echo "<pre>"; print_r($data['price']); die;
                //     foreach ($data['price'] as $key => $price) {
                //         $priceArr = explode("-",$price);
                //         $productIds = Product::select('id')->whereBetween('product_price',[$priceArr[0],$priceArr[1]])->pluck('id')->toArray();
                //     }
                //     // $productIds = call_user_func_array('array_merge', $productIds);
                //     $categoryProducts->whereIn('products.id',$productIds);
                //     // echo "<pre>"; print_r($productIds); die;
                //     // $implodePrices = implode('-',$data['price']);
                //     // $explodePrices = explode('-',$implodePrices);
                //     // $min = reset($explodePrices);
                //     // $max = end($explodePrices);
                //     /* echo "<pre>"; print_r($explodePrices); die; */
                //     // $productIds = Product::select('id')->whereBetween('product_price',[$min,$max])->pluck('id')->toArray();
                //     // $categoryProducts->whereIn('products.id',$productIds);
                // }


                // Checking for Price
                $productIds = array();
                if (isset($data['price']) && !empty($data['price'])) {
                    // echo "<pre>"; print_r($data['price']); die;
                    foreach ($data['price'] as $key => $price) {
                        $priceArr = explode("-",$price);
                        if(isset($priceArr[0]) && isset($priceArr[1])){
                            $productIds = Product::select('id')->whereBetween('product_price',[$priceArr[0],$priceArr[1]])->pluck('id')->toArray();
                        }
                    }
                    $productIds = array_unique(array_flatten($productIds));
                    $categoryProducts->whereIn('products.id',$productIds);
                }

                // Checking for Brand
                if (isset($data['brand']) && !empty($data['brand'])) {
                    $productIds = Product::select('id')->whereIn('brand_id',$data['brand'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id',$productIds);
                }

                $categoryProducts = $categoryProducts->Paginate(30);
                // dd($categoryProducts);
                // echo "Category exists"; die;
                return view('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            // echo $url = Route::getFacadeRoot()->current()->uri(); die;
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                // Getting Category Details
                $categoryDetails = Category::categoryDetails($url);
                // dd($categoryDetails);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // Checking for Sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product_latest") {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price_lowest") {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price_highest") {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    }
                }

                $categoryProducts = $categoryProducts->Paginate(30);
                // dd($categoryProducts);
                // echo "Category exists"; die;
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }

    public function vendorListing($vendorid)
    {
        // Get Vendor Shop Name
        $getVendorShop = Vendor::getVendorShop($vendorid);

        // Get Vendor Products
        $vendorProducts = Product::with('brand')->where('vendor_id',$vendorid)->where('status',1);

        $vendorProducts = $vendorProducts->paginate(30);
        // dd($vendorProducts);
        return view('front.products.vendor_listing')->with(compact('getVendorShop','vendorProducts'));
    }

    public function detail($id)
    {
        $productDetails = Product::with(['section','category','brand','attributes'=>function($query){
            $query->where('stock','>',0)->where('status',1);
        },'images','vendor'])->find($id)->toArray();
        // dd($productDetails);
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        // dd($categoryDetails);

        // Get Similar Products
        $similarProducts = Product::with('brand')->where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->limit(4)->inRandomOrder()->get()->toArray();
        // dd($similarProducts);

        // Set Session for Recently Viewed Products
        if(empty(Session::get('session_id'))){
            $session_id = md5(uniqid(rand(), true));
        }else {
            $session_id = Session::get('session_id');
        }

        Session::put('session_id',$session_id);

        // Insert product in to recently_viewed_products table if it doesn't exist already
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id'=>$id,'session_id'=>$session_id])->count();
        if($countRecentlyViewedProducts==0){
            DB::table('recently_viewed_products')->insert(['product_id'=>$id,'session_id'=>$session_id]);
        }

        // Get Recently Viewed Products IDs
        $recentProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id','!=',$id)->where('session_id',$session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');
        // dd($recentProductsIds);

        // Get Recently Viewed Products
        $recentlyViewedProducts = Product::with('brand')->whereIn('id',$recentProductsIds)->get()->toArray();
        // dd($recentlyViewedProducts);

        // Get Group Products (Products Color)
        $groupProducts = array();
        if(!empty($productDetails['group_code'])){
            $groupProducts = Product::select('id','product_image')->where('id','!=',$id)->where(['group_code'=>$productDetails['group_code'],'status'=>1])->get()->toArray();
            // dd($groupProducts);
        }

        $totalStock = ProductsAttribute::where('product_id',$id)->sum('stock');
        return view('front.products.detail')->with(compact('productDetails','categoryDetails','totalStock','similarProducts','recentlyViewedProducts','groupProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $getDiscountAttributePrice = Product::getDiscountAttributePrice($data['product_id'], $data['size']);
            return $getDiscountAttributePrice;
        }
    }

    public function cartAdd(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Check either Product Stock is available or not
            $getProductStock = ProductsAttribute::getProductStock($data['product_id'], $data['size']);
            if($getProductStock<$data['quantity']){
                return redirect()->back()->with('error_message','Required Quantity is not available!');
            }

            // Generate Session Id if one doesn't exist
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            // Check product either if already exists in the User Cart
            if(Auth::check()){
                // User is logged in
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'user_id'=>$user_id])->count();
            }else {
                // User is not logged in
                $user_id = 0;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'size'=>$data['size'], 'session_id'=>$session_id])->count();
            }

            if($countProducts>0){
                return redirect()->back()->with('error_message','Product already exists in Cart');
            }

            // Save Product in "carts" table
            $item = new Cart;
            $item->session_id = $session_id;
            $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->size = $data['size'];
            $item->quantity = $data['quantity'];
            $item->save();
            return redirect()->back()->with('success_message','Product has been added to cart! <a style="text-decoration: underline !important;" href="/cart">View Cart</a>');
        }
    }

    public function cart()
    {
        $getCartItems = Cart::getCartItems();
        // dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }

    public function cartUpdate(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Get Cart Details
            $cartDetails = Cart::find($data['cartid']);

            // Get Available stock of the product
            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();

            // echo "<pre>"; print_r($availableStock); die;

            // Checking if the stock required by the user is available
            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Required Product Stock is not available',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            }

            // Check if product size is available
            $availableSize = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();

            if($availableSize==0){
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Required Product Size is not available. Please choose another size.',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            }

            // Update the quantity
            Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Session::forget('couponAmount');
            Session::forget('couponCode');
            Cart::where('id',$data['cartid'])->delete();
            $getCartItems = Cart::getCartItems();
            // getting the total no. of items in cart
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
            ]);
        }
    }
    
    public function applyCoupon(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // forgettin the session when customer applies a new discount code
            Session::forget('couponAmount');
            Session::forget('couponCode');

            $getCartItems = Cart::getCartItems();
            // getting the total no. of items in cart
            $totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if($couponCount==0){
                return response()->json([
                    'status'=>false,
                    'totalCartItems'=>$totalCartItems,
                    'message'=>'Please enter a valid Coupon',
                    'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            } else {
                // Check for other coupon conditions

                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // Checking if coupon is Active
                if($couponDetails->status==0){
                    $message = "The coupon is not active!";
                }

                // Checking for expired coupon
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');

                if($expiry_date < $current_date){
                    $message = "The coupon is expired!";
                }

                // Checking if Discount Coupon is for Single Time
                if($couponDetails->coupon_type=="Single Time"){
                    // Check in users table if the coupon has been already applied by the user
                    $couponCount = Order::where(['coupon_code'=>$data['code'], 'user_id'=>Auth::user()->id])->count();
                    if($couponCount>=1){
                        $message = "You have already applied this coupon !";
                    }
                }

                // Checking if coupon is for selected categories only
                // Get all selected categories from "coupons" table and convert to array
                $catArr = explode(",", $couponDetails->categories);
                // Checking if any cart item doesn't belong to the coupon category set by admin
                $totalAmount = 0;
                foreach ($getCartItems as $key => $item) {
                    if(!in_array($item['product']['category_id'], $catArr)){
                        $message = "This coupon code is not for one of the selected products.";
                    }
                    $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                    // echo "<pre>"; print_r($attrPrice); die;
                    $totalAmount = $totalAmount + ($attrPrice['final_price'] * $item['quantity']);
                }

                // Checking if coupon code is for selected users only
                // Get all selected users from "coupons" table and convert to array
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(",", $couponDetails->users);

                    if (count($usersArr) > 0) {
                        // echo "<pre>"; print_r($usersArr); die;

                        // Getting user id's of al selected users
                        foreach ($usersArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first()->toArray();
                            $usersId[] = $getUserId['id'];
                        }

                        // Checking if any cart item doesn't belong to the coupon users set by admin
                        foreach ($getCartItems as $item) {
                            if (!in_array($item['user_id'], $usersId)) {
                                $message = "This coupon code is not applicable to your account. Try with valid coupon code!";
                            }
                        }
                    }
                }

                if ($couponDetails->vendor_id > 0) {
                    // echo $couponDetails->vendor_id; die;
                    $productIds = Product::select('id')->where('vendor_id', $couponDetails->vendor_id)->pluck('id')->toArray();
                    // echo "<pre>"; print_r($productIds); die;
                    // Checking if coupon belongs to vendor products
                    foreach ($getCartItems as $item) {
                        if (!in_array($item['product']['id'], $productIds)) {
                            $message = "This coupon code is not for you. Try with valid coupon code!";
                        }
                    }
                }

                // If any error message is present
                if(isset($message)){
                    return response()->json([
                        'status'=>false,
                        'totalCartItems'=>$totalCartItems,
                        'message'=>$message,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);
                } else {
                    // Coupon code is correct

                    // Checking if coupon amount type is Percentage or Fixed (Currency)
                    if($couponDetails->amount_type=="Fixed"){
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $totalAmount * ($couponDetails->amount/100);
                    }

                    $grand_total = $totalAmount - $couponAmount;

                    // Adding coupon code and amount in session variable
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Discount Coupon applied successfully. You have redeemed the discount!";

                    return response()->json([
                        'status'=>true,
                        'totalCartItems'=>$totalCartItems,
                        'couponAmount'=>$couponAmount,
                        'grand_total'=>$grand_total,
                        'message'=>$message,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview'=>(String)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);
                }
            }
        }
    }

    public function checkout(Request $request)
    {
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        // dd($deliveryAddresses);
        $countries = Country::where('status', 1)->get()->toArray();
        $getCartItems = Cart::getCartItems();
        // dd($getCartItems);

        if(count($getCartItems) == 0){
            $message = "Shopping Cart is empty! Please add products to proceed to checkout.";
            return redirect('cart')->with('error_message', $message);
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Validation for not selecting a delivery address
            if(empty($data['address_id'])){
                $message = "Please add or select a Delivery Address!";
                return redirect()->back()->with('error_message', $message);
            }

            // Validation for not selecting a payment method
            if(empty($data['payment_gateway'])){
                $message = "Please select a Payment Method!";
                return redirect()->back()->with('error_message', $message);
            }
            
            // Validation for not accepting the terms and conditions
            if(empty($data['accept'])){
                $message = "Please accept the Terms & Conditions";
                return redirect()->back()->with('error_message', $message);
            }

            // echo "<pre>"; print_r($data); die;
            // echo "Ready To Place Order"; die;

            // Getting the Delivery Address from 'address_id'
            $deliveryAddresses = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            // dd($deliveryAddresses);

            // Selecting payment_method as Cash On Delivery(COD) if COD is selected by user else payment_method will be set as prepaid.
            if($data['payment_gateway']=="COD"){
                $payment_method = "COD";
                $order_status = "New";
            } elseif($data['payment_gateway']=="Paypal"){
                $payment_method = "PayPal";
                $order_status = "Pending";
            } else {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }

            DB::beginTransaction();

            // Fetching GrandTotal Price of the Order made by the customer
            $total_price = 0;
            // $getCartItems = getCartItems();
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']);
            }
            
            // Calculate Shipping Charges
            $shipping_charges = 0;
            
            // Calculating Grand Total
            $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');
            
            // Inserting GrantTotal in Session Variable to use it in Thank You page
            Session::put('grand_total', $grand_total);

            // Inserting Order Details in 'Orders' table
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddresses['name'];
            $order->address = $deliveryAddresses['address'];
            $order->city = $deliveryAddresses['city'];
            $order->province = $deliveryAddresses['province'];
            $order->country = $deliveryAddresses['country'];
            $order->pincode = $deliveryAddresses['pincode'];
            $order->mobile = $deliveryAddresses['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;

            if(empty(Session::get('couponCode')) && empty(Session::get('couponAmount'))){
                $order->coupon_code = 0;
                $order->coupon_amount = 0;
            } else {
                $order->coupon_code = Session::get('couponCode');
                $order->coupon_amount = Session::get('couponAmount');
            }
            
            $order->order_status = $order_status;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();

            foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();
                // dd($getProductDetails);
                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->vendor_id = $getProductDetails['vendor_id'];
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                $cartItem->product_price = $getDiscountAttributePrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();

                
            }

            // Insert Order ID in session variable
            Session::put('order_id', $order_id);

            DB::commit();
            // echo $total_price; die;

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();

            // forgetting the session after the customer places the order
            Session::forget('couponAmount');
            Session::forget('couponCode');

            if($data['payment_gateway']=="COD"){
                // Send Order Email
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails
                ];
                Mail::send('emails.order', $messageData, function($message)use($email){
                    $message->to($email)->subject("Order Placed - E-Pasal");
                });

                foreach ($getCartItems as $item) {
                    // Reduce Product Stock every time a customer makes a purchase or orders a product
                    $getProductStock = ProductsAttribute::getProductStock($item['product_id'], $item['size']);
                    $newStock = $getProductStock - $item['quantity'];
                    ProductsAttribute::where(['product_id'=>$item['product_id'], 'size'=>$item['size']])->update(['stock'=>$newStock]);
                    // Reduce Product Stock Ends
                }

            } elseif ($data['payment_gateway']=="Paypal"){
                // if payment gateway is paypal, redirect the customer to Paypal page after saving the Order
                return redirect("/paypal");
            } else {
                echo "Other Online Payment Methods remaining !!";
            }

            // echo "Order has been placed successfully."; die;
            return redirect('thanks');
        }
        
        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'getCartItems'));
    }

    public function thanks()
    {
        if(Session::has('order_id'))
        {
            // Empty the cart
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.products.thanks');
        } else {
            return redirect('cart');
        }
    }
}
