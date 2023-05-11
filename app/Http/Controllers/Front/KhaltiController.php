<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\KhaltiPayment;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    public function verifyPayment(Request $request)
    {
        $token = $request->token;
        $amount = $request->amount;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => $amount
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.khalti_secret_key');

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response = json_encode(array('status_code'=>$status_code,'data'=>json_decode($response)));
		return json_decode($response, true);

        
    }

    public function storePayment(Request $request)
    {
        if(!Session::has('order_id')){
            return redirect('cart');
        }
        
        $response = $request->response;
        // Store Payment Details in Database
        if($response['status_code']==200) {
            $payment_id = $response['data']['idx'];
            // $payer_id = $response['data']['user']['idx'];
            $payer_email = $response['data']['user']['name'];
            $amount = $response['data']['amount'];
            $payment_status = $response['data']['state']['name'];

            $khaltiPayment = new KhaltiPayment;
            $khaltiPayment->order_id = Session::get('order_id');
            $khaltiPayment->user_id = Auth::user()->id;
            $khaltiPayment->payment_id = $payment_id;
            $khaltiPayment->payer_id = Auth::user()->id;
            $khaltiPayment->payer_email = $payer_email;
            $khaltiPayment->amount = $amount;
            $khaltiPayment->currency = env('KHALTI_CURRENCY');
            $khaltiPayment->payment_status = $payment_status;
            $khaltiPayment->save();

            // return "Payment is Successful. Your transaction is ".$arr['id'];

            // Update the Order
            $order_id = Session::get('order_id');

            // Update Order Status to paid
            Order::where('id', $order_id)->update(['order_status'=>'Paid']);

            $orderDetails = Order::with('orders_products')->where('id', $order_id)->first()->toArray();
            $order_id = Session::get('grand_total');

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

            foreach ($orderDetails['orders_products'] as $key => $order) {
                // Reduce Product Stock every time a customer makes a purchase or orders a product
                $getProductStock = ProductsAttribute::getProductStock($order['product_id'], $order['product_size']);
                $newStock = $getProductStock - $order['product_qty'];
                ProductsAttribute::where(['product_id'=>$order['product_id'], 'size'=>$order['product_size']])->update(['stock'=>$newStock]);
                // Reduce Product Stock Ends
            }

            // Empty the cart after the successful transaction
            Cart::where('user_id', Auth::user()->id)->delete();

            // return view('front.khalti.success')->with(compact($orderDetails));

        } else {
            return $response->getMessage();
        }   
    }

    public function success()
    {
        return view('front.khalti.success');
    }
}
