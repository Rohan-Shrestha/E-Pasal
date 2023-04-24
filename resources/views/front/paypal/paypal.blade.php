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
                <h3>PLEASE MAKE PAYMENT FOR YOUR ORDER</h3>
                <form action="#" method="post">@csrf
                    <input type="hidden" name="amount" value="{{ round(Session::get('grand_total')*0.0076, 2) }}">
                    <!-- PayPal Logo -->
                    <table border="0" cellpadding="10" cellspacing="0" align="center">
                        <tr>
                            <td align="center"></td>
                        </tr>
                        <tr>
                            <td align="center"><a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" alt="Check out with PayPal" /></a></td>
                        </tr>
                    </table><!-- PayPal Logo -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection