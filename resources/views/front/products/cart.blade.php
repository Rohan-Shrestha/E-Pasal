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
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('cart') }}">Cart</a>
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
        @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <li><?php echo Session::get('error_message'); ?></li>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <li><?php echo Session::get('success_message'); ?></li>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div id="appendCartItems">
                    @include('front.products.cart_items')
                </div>
                <!-- Coupon -->
                <div class="coupon-continue-checkout u-s-m-b-60 discountForm">
                    <div class="coupon-area">
                        <h6>Enter your coupon code if you have one.</h6>
                        <div class="coupon-field">
                            <form id="ApplyCoupon" method="post" action="javascript:void(0);" @if(Auth::check()) user="1" @endif>@csrf
                                <label class="sr-only" for="coupon-code">Apply Coupon</label>
                                <input id="code" name="code" type="text" class="text-field" placeholder="Enter Coupon Code">
                                <button type="submit" class="button">Apply Coupon</button>
                            </form>
                        </div>
                    </div>
                    <div class="button-area">
                        <a href="{{ url('/') }}" class="continue">Continue Shopping</a>
                        <a href="{{ url('checkout') }}" class="checkout">Proceed to Checkout</a>
                    </div>
                </div>
                <!-- Coupon /- -->
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection