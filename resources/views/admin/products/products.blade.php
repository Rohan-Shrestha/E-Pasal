@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Products</h4>
                <!-- <p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p> -->
                <a style="max-width: 150px; float: right; display: inline-block;" href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-primary">Add Product</a>
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <li>{{ Session::get('success_message')}}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="table-responsive pt-3">
                    <table id="products" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Product Name
                                </th>
                                <th>
                                    Product Code
                                </th>
                                <th>
                                    Product Color
                                </th>
                                <th>
                                    Product Photo
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Section
                                </th>
                                <th>
                                    Added By
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
                            @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product['id'] }}
                                </td>
                                <td>
                                    {{ $product['product_name'] }}
                                </td>
                                <td>
                                    {{ $product['product_code'] }}
                                </td>
                                <td>
                                    {{ $product['product_color'] }}
                                </td>
                                <td>
                                    @if(!empty($product['product_image']))
                                    <img style="width: 100px; height: 100px;" src="{{ asset('front/images/product_images/small/'.$product['product_image']) }}" alt="product photo">
                                    @else
                                    <img style="width: 100px; height: 100px;" src="{{ asset('front/images/product_images/small/no_image.png') }}" alt="Photo Not Added">
                                    @endif
                                </td>
                                <td>
                                    {{ $product['category']['category_name'] }}
                                </td>
                                <td>
                                    {{ $product['section']['name'] }}
                                </td>
                                <td>
                                    @if ($product['admin_type']=="vendor")
                                    <?php /* <a target="_blank" href="{{ url('admin/view-vendor-details/'.$product['admin_id']) }}">{{ ucfirst($product['admin_type']) }}</a> */ ?>
                                    {{ ucfirst($product['admin_type']) }}
                                    @else
                                    {{ ucfirst($product['admin_type']) }}
                                    @endif
                                </td>
                                <td>
                                    @if($product['status']==1)
                                    <a title="Active" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="Active"></i></a>
                                    @else
                                    <a title="Inactive" class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-remove" status="Inactive"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>
                                    <a title="Add Attributes" href="{{ url('admin/add-edit-attributes/'.$product['id']) }}"><i style="font-size: 25px;" class="mdi mdi-plus-box"></i></a>
                                    <a title="Add Images" href="{{ url('admin/add-images/'.$product['id']) }}"><i style="font-size: 25px;" class="mdi mdi-library-plus"></i></a>
                                    <a title="Delete Product" href="javascript:void(0)" class="confirmDelete" module="product" module_id="{{ $product['id'] }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a>
                                    <!-- <a title="Product" class="confirmDelete" href="{{ url('admin/delete-product/'.$product['id']) }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a> -->
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