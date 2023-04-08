@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="card-title">Coupons</h4>
                <?php /* <h6 class="font-weight-normal mb-0">Update Admin Password</h6> */ ?>
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
                <h4 class="card-title">{{ $title }}</h4>
                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <li>{{ Session::get('error_message')}}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <li>{{ Session::get('success_message')}}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form class="forms-sample" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                    <div class="form-group">
                        <label for="coupon_option">Coupon Option</label>
                        <span><input id="AutomaticCoupon" type="radio" name="coupon_option" value="Automatic" checked="">&nbsp;&nbsp;Automatic&nbsp;&nbsp;</span>
                        <span><input id="ManualCoupon" type="radio" name="coupon_option" value="Manual" checked="">&nbsp;&nbsp;Manual&nbsp;&nbsp;</span>
                    </div>
                    <div class="form-group" style="display: none;" id="couponField">
                        <label for="coupon_code">Coupon Code</label>
                        <input type="text" class="form-control" name="coupon_code" placeholder="Enter Coupon Code">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control text-dark">
                            <option value="">Select</option>
                            @foreach ($categories as $section)
                            <optgroup label="{{ $section['name'] }}"></optgroup>
                            @foreach ($section['categories'] as $category)
                            <option @if (!empty($coupon['category_id']==$category['id'])) selected="" @endif value="{{ $category['id'] }}">&nbsp;&nbsp;&nbsp;--&nbsp;{{ $category['category_name'] }}</option>
                            @foreach ($category['subcategories'] as $subcategory)
                            <option @if (!empty($coupon['category_id']==$subcategory['id'])) selected="" @endif value="{{ $subcategory['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;{{ $subcategory['category_name'] }}</option>
                            @endforeach
                            @endforeach
                            @endforeach
                        </select>
                        <?php /* <input type="text" class="form-control" id="section_id" placeholder="Enter Coupon Name" name="section_id" 
                                @if(!empty($coupon['name'])) value="{{ $coupon['name'] }}" 
                                @else value="{{ old('section_id') }}" @endif> */ ?>
                    </div>
                    <div class="loadFilters">
                        @include('admin.filters.category_filters')
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Select Brand</label>
                        <?php /* <select name="brand_id" id="brand_id" class="form-control" style="color: #495057;"> */ ?>
                        <select name="brand_id" id="brand_id" class="form-control text-dark">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                            <option @if (!empty($coupon['brand_id']==$brand['id'])) selected="" @endif value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="coupon_name">Coupon Name</label>
                        <input type="text" class="form-control" id="coupon_name" placeholder="Enter Coupon Name" name="coupon_name" @if(!empty($coupon['coupon_name'])) value="{{ $coupon['coupon_name'] }}" @else value="{{ old('coupon_name') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code</label>
                        <input type="text" class="form-control" id="coupon_code" placeholder="Enter Coupon Code" name="coupon_code" @if(!empty($coupon['coupon_code'])) value="{{ $coupon['coupon_code'] }}" @else value="{{ old('coupon_code') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_color">Coupon Color</label>
                        <input type="text" class="form-control" id="coupon_color" placeholder="Enter Coupon Color" name="coupon_color" @if(!empty($coupon['coupon_color'])) value="{{ $coupon['coupon_color'] }}" @else value="{{ old('coupon_color') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_price">Coupon Price</label>
                        <input type="text" class="form-control" id="coupon_price" placeholder="Enter Coupon Price" name="coupon_price" @if(!empty($coupon['coupon_price'])) value="{{ $coupon['coupon_price'] }}" @else value="{{ old('coupon_price') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_discount">Coupon Discount (%)</label>
                        <input type="text" class="form-control" id="Coupon_discount" placeholder="Enter Coupon Discount" name="coupon_discount" @if(!empty($coupon['coupon_discount'])) value="{{ $coupon['coupon_discount'] }}" @else value="{{ old('coupon_discount') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_weight">Coupon Weight</label>
                        <input type="text" class="form-control" id="Coupon_weight" placeholder="Enter Coupon Weight" name="coupon_weight" @if(!empty($coupon['coupon_weight'])) value="{{ $coupon['coupon_weight'] }}" @else value="{{ old('coupon_weight') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="group_code">Group Code</label>
                        <input type="text" class="form-control" id="Group_code" placeholder="Enter Group Code" name="group_code" @if(!empty($coupon['group_code'])) value="{{ $coupon['group_code'] }}" @else value="{{ old('group_code') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="coupon_image">Coupon Photo (Recommended Size:1000x1000)</label>
                        <input type="file" class="form-control" id="coupon_image" name="coupon_image">
                        @if (!empty($coupon['coupon_image']))
                        <a target="_blank" href="{{ url('front/images/coupon_images/large/'.$coupon['coupon_image']) }}">View Photo</a>&nbsp;|&nbsp;
                        <a href="javascript:void(0)" class="confirmDelete" module="coupon-image" module_id="{{ $coupon['id'] }}">Delete Photo</a>
                        @endif
                        <?php /* @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">View Photo</a>
                                <input type="hidden" name="current_coupon_image" value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                        */ ?>
                    </div>
                    <div class="form-group">
                        <label for="coupon_video">Coupon Video (Recommended Size: Less than 2 MB)</label>
                        <input type="file" class="form-control" id="coupon_video" name="coupon_video">
                        @if (!empty($coupon['coupon_video']))
                        <a target="_blank" href="{{ url('front/videos/coupon_videos/'.$coupon['coupon_video']) }}">View Video</a>&nbsp;|&nbsp;
                        <a href="javascript:void(0)" class="confirmDelete" module="coupon-video" module_id="{{ $coupon['id'] }}">Delete Video</a>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Coupon Description</label>
                        <textarea name="description" class="form-control" id="description" cols="9" rows="3">{{ $coupon['description'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" placeholder="Enter Meta Title" name="meta_title" @if(!empty($coupon['meta_title'])) value="{{ $coupon['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" class="form-control" id="meta_description" placeholder="Enter Meta Description" name="meta_description" @if(!empty($coupon['meta_description'])) value="{{ $coupon['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" class="form-control" id="meta_keywords" placeholder="Enter Meta Keywords" name="meta_keywords" @if(!empty($coupon['meta_keywords'])) value="{{ $coupon['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="is_featured">Featured Item</label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if (!empty($coupon['is_featured']) && $coupon['is_featured']=="Yes" ) checked="" @endif>
                    </div>
                    <div class="form-group">
                        <label for="is_bestseller">Best Seller Item</label>
                        <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes" @if (!empty($coupon['is_bestseller']) && $coupon['is_bestseller']=="Yes" ) checked="" @endif>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection