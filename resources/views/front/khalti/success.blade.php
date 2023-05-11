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
            <!-- <h2>Payment</h2> -->
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home mr-2"></i>
                    <a href="javascript:;">Home</a>
                </li>
                <li class="has-separator">
                    <a href="javascript:;">Payment</a>
                </li>
                <li class="is-marked">
                    <a href="javascript:;">Thank You</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<hr>
<!-- Page Introduction Wrapper /- -->
<!-- Cart-Page -->
<div class="page-cart u-s-p-t-80 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" align="center">
                <h3>YOUR PAYMENT HAS BEEN CONFIRMED</h3>
                <p>Thank You for your purchase. We will process your order very soon.</p>
                <p>Your order number is <strong>{{ Session::get('order_id') }}</strong> and total amount paid is <strong>Rs. {{ Session::get('grand_total') }}</strong></p>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('couponCode');
    Session::forget('couponAmount');
?>