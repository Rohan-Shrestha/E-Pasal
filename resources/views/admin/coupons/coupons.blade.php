@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Coupons</h4>
                <!-- <p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p> -->
                <a style="max-width: 150px; float: right; display: inline-block;" href="{{ url('admin/add-edit-coupon') }}" class="btn btn-block btn-primary">Add Coupon</a>
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <li>{{ Session::get('success_message')}}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="table-responsive pt-3">
                    <table id="coupons" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Coupon Code
                                </th>
                                <th>
                                    Coupon Type
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Expiry Date
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                            <tr>
                                <td>
                                    {{ $coupon['id'] }}
                                </td>
                                <td>
                                    {{ $coupon['coupon_code'] }}
                                </td>
                                <td>
                                    {{ $coupon['coupon_type'] }}
                                </td>
                                <td>
                                    {{ $coupon['amount'] }}
                                    @if($coupon['amount_type']=="Percentage")
                                        %
                                    @else
                                        NPR
                                    @endif
                                </td>
                                <td>
                                    {{ $coupon['expiry_date'] }}
                                </td>
                                <td>
                                    @if($coupon['status']==1)
                                    <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="Active"></i></a>
                                    @else
                                    <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-remove" status="Inactive"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="coupon" module_id="{{ $coupon['id'] }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a>
                                    <?php /* <a title="coupon" class="confirmDelete" href="{{ url('admin/delete-coupon/'.$coupon['id']) }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a> */ ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection