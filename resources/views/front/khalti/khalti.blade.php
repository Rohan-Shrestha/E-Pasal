<?php

use App\Models\Product;
use Illuminate\Support\Facades\Session;
?>
@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style">
    <div class="container">
        <div class="page-intro">
            <!-- <h2>Cart</h2> -->
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home mr-2"></i>
                    <a href="javascript:;">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Proceed to Payment</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Cart-Page -->
<div class="page-cart u-s-p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" align="center">
                <h3>Please make payment for your order</h3><br>
                <!-- <form action="" method="post">@csrf -->
                    <input type="hidden" name="amount" value="{{ round(Session::get('grand_total')*0.0076, 2) }}">
                    <!-- Khalti Payment Button -->
                    <button id="payment-button" class="btn">Pay with Khalti</button>
                    <!-- Khalti Payment Button -->
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>

<script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "{{ config('app.khalti_public_key') }}",
        "productIdentity": "{{ $orderDetails['orders_products'][0]['product_id'] }}",
        "productName": "{{ $orderDetails['orders_products'][0]['product_name'] }}",
        "productUrl": "http://127.0.0.1:8000/product/{{ $orderDetails['orders_products'][0]['product_id'] }}",
        "paymentPreference": [
            "KHALTI",
            "EBANKING",
            "MOBILE_BANKING",
            "CONNECT_IPS",
            "SCT",
            ],
        "eventHandler": {
            onSuccess (payload) {
                // hit merchant api for initiating verfication
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{},
                    url:'',
                    type:'POST',
                    success:function(resp){
                        
                    },error:function(){
                        alert('Error');
                    }
                });
                console.log(payload);
            },
            onError (error) {
                console.log(error);
            },
            onClose () {
                console.log('widget is closing');
            }
        }
    };
    
    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: 1000});
    }
</script>
<!-- Cart-Page /- -->
@endsection