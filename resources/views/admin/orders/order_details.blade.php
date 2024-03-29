<?php
use App\Models\Product;
use App\Models\OrdersLog;
?>
@extends('admin.layout.layout')
@section('content')

@if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <li>{{ Session::get('success_message')}}</li>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Order Details</h3>
        <h6 class="font-weight-normal mb-0"><a href="{{ url('admin/orders') }}">Back to Orders</a></h6>
      </div>
      <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
          <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <i class="mdi mdi-calendar"></i> Today (1 Jan 2023)
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
              <a class="dropdown-item" href="#">January - March</a>
              <a class="dropdown-item" href="#">March - June</a>
              <a class="dropdown-item" href="#">June - August</a>
              <a class="dropdown-item" href="#">August - November</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Order Details</h4>
        
        <div class="form-group" style="height: 15px;">
          <label><strong>Order ID:</strong> </label>
          <label>#{{ $orderDetails['id'] }}</label>
        </div>
        <div class="form-group" style="height: 15px;">
          <label><strong>Order Date:</strong> </label>
          <label>{{ date('Y-m-d h:i:s', strtotime($orderDetails['created_at'])); }}</label>
        </div>
        <div class="form-group" style="height: 15px;">
          <label><strong>Order Status:</strong> </label>
          <label>{{ $orderDetails['order_status'] }}</label>
        </div>
        <div class="form-group" style="height: 15px;">
          <label><strong>Order Total:</strong> </label>
          <label>Rs. {{ $orderDetails['grand_total'] }}</label>
        </div>
        <div class="form-group" style="height: 15px;">
          <label><strong>Shipping Charges:</strong> </label>
          <label>Rs. {{ $orderDetails['shipping_charges'] }}</label>
        </div>
        @if(!($orderDetails['coupon_code']) == 0)
            <div class="form-group" style="height: 15px;">
              <label><strong>Coupon Code:</strong> </label>
              <label>{{ $orderDetails['coupon_code'] }}</label>
            </div>
            <div class="form-group" style="height: 15px;">
              <label><strong>Coupon Amount:</strong> </label>
              <label>Rs. {{ $orderDetails['coupon_amount'] }}</label>
            </div>
        @endif
        <div class="form-group" style="height: 15px;">
          <label><strong>Payment Method:</strong> </label>
          <label>{{ $orderDetails['payment_method'] }}</label>
        </div>
        <div class="form-group" style="height: 15px;">
          <label><strong>Payment Gateway:</strong> </label>
          <label>{{ $orderDetails['payment_gateway'] }}</label>
        </div>

      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Customer Details</h4>

            <div class="form-group" style="height: 15px;">
                <label><strong>Name:</strong> </label>
                <label>{{ $userDetails['name'] }}</label>
            </div>
            @if(!empty($userDetails['address']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Address:</strong> </label>
                    <label>{{ $userDetails['address'] }}</label>
                </div>
            @endif
            @if(!empty($userDetails['city']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>City:</strong> </label>
                    <label>{{ $userDetails['city'] }}</label>
                </div>
            @endif
            @if(!empty($userDetails['province']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Province:</strong> </label>
                    <label>{{ $userDetails['province'] }}</label>
                </div>
            @endif
            @if(!empty($userDetails['country']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Country:</strong> </label>
                    <label>{{ $userDetails['country'] }}</label>
                </div>
            @endif
            @if(!empty($userDetails['pincode']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Postal Code:</strong> </label>
                    <label>{{ $userDetails['pincode'] }}</label>
                </div>
            @endif
            <div class="form-group" style="height: 15px;">
                <label><strong>Phone:</strong> </label>
                <label>{{ $userDetails['mobile'] }}</label>
            </div>
            <div class="form-group" style="height: 15px;">
                <label><strong>Email:</strong> </label>
                <label>{{ $userDetails['email'] }}</label>
            </div>

      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Delivery Address</h4>

            <div class="form-group" style="height: 15px;">
                <label><strong>Name:</strong> </label>
                <label>{{ $orderDetails['name'] }}</label>
            </div>
            @if(!empty($orderDetails['address']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Address:</strong> </label>
                    <label>{{ $orderDetails['address'] }}</label>
                </div>
            @endif
            @if(!empty($orderDetails['city']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>City:</strong> </label>
                    <label>{{ $orderDetails['city'] }}</label>
                </div>
            @endif
            @if(!empty($orderDetails['province']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Province:</strong> </label>
                    <label>{{ $orderDetails['province'] }}</label>
                </div>
            @endif
            @if(!empty($orderDetails['country']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Country:</strong> </label>
                    <label>{{ $orderDetails['country'] }}</label>
                </div>
            @endif
            @if(!empty($orderDetails['pincode']))
                <div class="form-group" style="height: 15px;">
                    <label><strong>Postal Code:</strong> </label>
                    <label>{{ $orderDetails['pincode'] }}</label>
                </div>
            @endif
            <div class="form-group" style="height: 15px;">
                <label><strong>Phone:</strong> </label>
                <label>{{ $orderDetails['mobile'] }}</label>
            </div>

      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Update Order Status</h4>

        @if(Auth::guard('admin')->user()->type!="vendor")
            <form action="{{ url('admin/update-order-status') }}" method="post">@csrf
                <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                <select name="order_status" id="order_status" required="">
                    <option value="" selected="">Select</option>
                    @foreach ($orderStatuses as $status)
                        <option value="{{ $status['name'] }}" @if(!empty($orderDetails['order_status']) && $orderDetails['order_status'] == $status['name']) selected="" @endif>{{ $status['name'] }}</option>
                    @endforeach
                </select>
                <input type="text" name="courier_name" id="courier_name" placeholder="Courier Name">
                <input type="text" name="tracking_number" id="tracking_number" placeholder="Tracking Number">
                <button type="submit" class="btn btn-outline-primary mr-2 mt-2 mb-2">Update</button>
            </form>
            <br>
            @foreach ($orderLog as $key => $log)
            <?php /* echo "<pre>"; print_r($log['orders_products'][$key]['product_code']); die; */ ?>
              <strong>{{ $log['order_status'] }}</strong>
              <?php /* @if ($log['order_status']=="Shipped") */ ?>
                @if(isset($log['order_item_id']) && $log['order_item_id']>0)
                  @php $getItemDetails = OrdersLog::getItemDetails($log['order_item_id']); @endphp
                    - for item {{ $getItemDetails['product_code'] }}
                    @if (!empty($getItemDetails['courier_name']))
                      <br><span>Courier Name: {{ $getItemDetails['courier_name'] }}</span>
                    @endif
                    @if (!empty($getItemDetails['tracking_number']))
                      <br><span>Tracking Number: {{ $getItemDetails['tracking_number'] }}</span>
                    @endif
                  <?php /*
                  @else
                    @if (!empty($orderDetails['courier_name']))
                      <br><span>Courier Name: {{ $orderDetails['courier_name'] }}</span>
                    @endif
                    @if (!empty($orderDetails['tracking_number']))
                      <br><span>Tracking Number: {{ $orderDetails['tracking_number'] }}</span>
                    @endif
                  */ ?>
                @endif
              <?php /* @endif */ ?>
              <br>{{ date('Y-m-d h:i:s', strtotime($log['created_at'])); }}<br>
              <hr>
            @endforeach
        @else
            This feature is restricted !
        @endif

      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Ordered Products</h4>
            <table class="table table-striped">
                <tr class="table-primary">
                    <th>Product Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Size</th>
                    <th>Product Color</th>
                    <th>Product Quantity</th>
                    <th>Item Status</th>
                </tr>
                @foreach ($orderDetails['orders_products'] as $product)
                    <tr>
                        <td>
                            @php $getProductImage = Product::getProductImage($product['product_id']); @endphp
                            <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width: 65px; height: 65px;" src="{{ asset('front/images/product_images/small/'.$getProductImage) }}" alt="Product Image"></a>
                        </td>
                        <td>{{ $product['product_code'] }}</td>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['product_size'] }}</td>
                        <td>{{ $product['product_color'] }}</td>
                        <td>{{ $product['product_qty'] }}</td>
                        <td>
                            <form action="{{ url('admin/update-order-item-status') }}" method="post">@csrf
                                <input type="hidden" name="order_item_id" value="{{ $product['id'] }}">
                                <select name="order_item_status" id="order_item_status" class="mt-2 mb-2" required="">
                                    <option value="">Select</option>
                                    @foreach ($orderItemStatuses as $status)
                                        <option value="{{ $status['name'] }}" @if(!empty($product['item_status']) && $product['item_status'] == $status['name']) selected="" @endif>{{ $status['name'] }}</option>
                                    @endforeach
                                </select><br>
                                <input style="width: 120px;" type="text" name="item_courier_name" id="item_courier_name" class="mt-2 mb-2" placeholder="Courier Name" @if(!empty($product['courier_name'])) value="{{ $product['courier_name'] }}" @endif>
                                <input style="width: 120px;" type="text" name="item_tracking_number" id="item_tracking_number" class="mt-2 mb-2" placeholder="Tracking Number" @if(!empty($product['tracking_number'])) value="{{ $product['tracking_number'] }}" @endif>
                                <button type="submit" class="mt-2 mb-2">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
      </div>
    </div>
  </div>
</div>

@endsection