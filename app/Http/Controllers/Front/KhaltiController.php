<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KhaltiController extends Controller
{
    public function khalti()
    {
        if(Session::has('order_id')){

            $order_id = Session::get('order_id');

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
            // dd($orderDetails);

            return view('front.khalti.khalti')->with(compact('orderDetails'));
        } else {
            return redirect('cart');
        }
    }
}
