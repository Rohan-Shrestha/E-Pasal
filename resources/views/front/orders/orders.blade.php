@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style">
    <div class="container">
        <div class="page-intro">
            <!-- <h2>My Orders</h2> -->
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home mr-2"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">Orders</a>
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
            <table class="table table-striped table-borderless">
                <tr class="table-primary">
                    <th>Order ID</th>
                    <th>Ordered Products</th>
                    <th>Payment Method</th>
                    <th>Net Price</th>
                    <th>Created On</th>
                    <th>Action</th>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>
                                @foreach ($order['orders_products'] as $product)
                                    {{ $product['product_code'] }}<br>
                                @endforeach
                            </td>
                            <td>{{ $order['payment_method'] }}</td>
                            <td>{{ $order['grand_total'] }}</td>
                            <td>{{ date('Y-m-d h:i:s', strtotime($order['created_at'])); }}</td>
                            <td style="text-decoration-line: underline;"><a href="{{ url('user/orders/'.$order['id']) }}">View Details</a></td>
                        </tr>
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection