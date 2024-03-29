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
<hr>
<!-- Page Introduction Wrapper /- -->
<!-- Cart-Page -->
<div class="page-cart u-s-p-t-80 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" align="center">
                <h3>PLEASE MAKE PAYMENT FOR YOUR ORDER</h3>
                <form action="{{ route('payment') }}" method="post">@csrf
                    <input type="hidden" name="amount" value="{{ round(Session::get('grand_total')*0.0076, 2) }}">
                    <!-- PayPal Logo -->
                    <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" />
                    <!-- PayPal Logo -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection