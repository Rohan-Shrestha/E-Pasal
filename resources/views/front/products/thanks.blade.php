<?php

use App\Models\Product;
use Illuminate\Support\Facades\Session;
?>
@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Cart</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="javascript:;">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Thank You</a>
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
                <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY !</h3>
                <p>Your order number is <strong>{{ Session::get('order_id') }}</strong> and Total Price is <strong>Rs. {{ Session::get('grand_total') }}</strong></p>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection