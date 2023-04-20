<?php
use App\Models\Product;
?>
@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Order #{{ $orderDetails['id'] }} Details</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="javascript:;">Home</a>
                </li>
                <li class="is-marked">
                    <a href="{{ url('user/orders') }}">Orders</a>
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
            <table class="table table-striped">
                <tr class="table-primary">
                    <td colspan="2"><strong>Order Details</strong></td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td>{{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])); }}</td>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>{{ $orderDetails['order_status'] }}</td>
                </tr>
                <tr>
                    <td>Order Total</td>
                    <td>Rs. {{ $orderDetails['grand_total'] }}</td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td>Rs. {{ $orderDetails['shipping_charges'] }}</td>
                </tr>
                @if($orderDetails['coupon_code']!=0 && $orderDetails['coupon_code']!="")
                    <tr>
                        <td>Coupon Code</td>
                        <td>{{ $orderDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Amount</td>
                        <td>Rs. {{ $orderDetails['coupon_amount'] }}</td>
                    </tr>
                @endif
                <tr>
                    <td>Payment Method</td>
                    <td>{{ $orderDetails['payment_method'] }}</td>
                </tr>
            </table>
            <table class="table table-striped">
                <tr class="table-primary">
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Quantity</th>
                </tr>
                @foreach ($orderDetails['orders_products'] as $product)
                    <tr>
                        <td>
                            @php $getProductImage = Product::getProductImage($product['product_id']); @endphp
                            <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width: 80px;" src="{{ asset('front/images/product_images/small/'.$getProductImage) }}" alt="Product Image"></a>
                        </td>
                        <td>{{ $product['product_code'] }}</td>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['product_size'] }}</td>
                        <td>{{ $product['product_color'] }}</td>
                        <td>{{ $product['product_qty'] }}</td>
                    </tr>
                @endforeach
            </table>
            <table class="table table-striped">
                <tr class="table-primary">
                    <td colspan="2"><strong>Delivery Address</strong></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $orderDetails['name'] }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $orderDetails['address'] }}</td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>{{ $orderDetails['city'] }}</td>
                </tr>
                <tr>
                    <td>Province</td>
                    <td>{{ $orderDetails['province'] }}</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>{{ $orderDetails['country'] }}</td>
                </tr>
                <tr>
                    <td>Postal Code</td>
                    <td>{{ $orderDetails['pincode'] }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $orderDetails['mobile'] }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $orderDetails['email'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection