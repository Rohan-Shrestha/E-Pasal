@extends('admin.layout.layout')
@section('content')
<!-- <div class="main-panel">
  <div class="content-wrapper"> -->
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Update Vendor Details</h3>
        <!-- <h6 class="font-weight-normal mb-0">Update Admin Password</h6> -->
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
@if($slug=="personal")
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Update Personal Information</h4>
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

        <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="form-group">
            <label>Vendor Username/Email</label>
            <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
          </div>
          <div class="form-group">
            <label for="vendor_name">Name</label>
            <input type="text" class="form-control" id="vendor_name" placeholder="Enter Full Name" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}" required="">
          </div>

          <div class="form-group">
            <label for="vendor_address">Address</label>
            <input type="text" class="form-control" id="vendor_address" placeholder="Enter Address" name="vendor_address" value="{{ $vendorDetails['address'] }}" required="">
          </div>
          <div class="form-group">
            <label for="vendor_city">City</label>
            <input type="text" class="form-control" id="vendor_city" placeholder="Enter City" name="vendor_city" value="{{ $vendorDetails['city'] }}" required="">
          </div>
          <div class="form-group">
            <label for="vendor_province">Province</label>
            <input type="text" class="form-control" id="vendor_province" placeholder="Enter Province" name="vendor_province" value="{{ $vendorDetails['province'] }}" required="">
          </div>
          <div class="form-group">
            <label for="vendor_country">Country</label>
            <!-- <input type="text" class="form-control" id="vendor_country" placeholder="Enter Country" name="vendor_country" value="{{ $vendorDetails['country'] }}" required=""> -->
            <select class="form-control" id="vendor_country" name="vendor_country" style="color: #495057">
              <option value="">Select Country</option>
              @foreach($countries as $country)
              <option value="{{ $country['country_name'] }}" @if ($country['country_name']==$vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="vendor_pincode">Pincode</label>
            <input type="text" class="form-control" id="vendor_pincode" placeholder="Enter Pincode" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}" required="">
          </div>
          <div class="form-group">
            <label for="vendor_mobile">Mobile</label>
            <input type="text" class="form-control" id="vendor_mobile" placeholder="Enter 10 Digits Mobile Number" name="vendor_mobile" value="{{ $vendorDetails['mobile'] }}" required="">
          </div>
          <div class="form-group">
            <label for="vendor_image">Profile Photo</label>
            <input type="file" class="form-control" id="vendor_image" name="vendor_image">
            @if(!empty(Auth::guard('admin')->user()->image))
            <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">View Photo</a>
            <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
            @endif
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <button type="reset" class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
@elseif($slug=="business")
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Update Business Information</h4>
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

        <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="form-group">
            <label>Vendor Username/Email</label>
            <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
          </div>
          <div class="form-group">
            <label for="shop_name">Shop Name</label>
            <input type="text" class="form-control" id="shop_name" placeholder="Enter Shop Name" name="shop_name" @if(isset($vendorDetails['shop_name'])) value="{{ $vendorDetails['shop_name'] }}" @endif required="">
          </div>

          <div class="form-group">
            <label for="shop_address">Shop Address</label>
            <input type="text" class="form-control" id="shop_address" placeholder="Enter Shop Address" name="shop_address" @if(isset($vendorDetails['shop_address'])) value="{{ $vendorDetails['shop_address'] }}" @endif required="">
          </div>
          <div class="form-group">
            <label for="shop_city">Shop City</label>
            <input type="text" class="form-control" id="shop_city" placeholder="Enter Shop City" name="shop_city" @if(isset($vendorDetails['shop_city'])) value="{{ $vendorDetails['shop_city'] }}" @endif required="">
          </div>
          <div class="form-group">
            <label for="shop_province">Shop Province</label>
            <input type="text" class="form-control" id="shop_province" placeholder="Enter Shop Province" name="shop_province" @if(isset($vendorDetails['shop_province'])) value="{{ $vendorDetails['shop_province'] }}" @endif required="">
          </div>
          <div class="form-group">
            <label for="shop_country">Shop Country</label>
            <?php /* <input type="text" class="form-control" id="shop_country" placeholder="Enter Shop Country" name="shop_country" value="{{ $vendorDetails['shop_country'] }}" required=""> */ ?>
            <select class="form-control" id="shop_country" name="shop_country" style="color: #495057">
              <option value="">Select Country</option>
              @foreach($countries as $country)
              <option value="{{ $country['country_name'] }}" @if (isset($vendorDetails['shop_country']) && $country['country_name']==$vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="shop_pincode">Shop Pincode</label>
            <input type="text" class="form-control" id="shop_pincode" placeholder="Enter Shop Pincode" name="shop_pincode" @if(isset($vendorDetails['shop_pincode'])) value="{{ $vendorDetails['shop_pincode'] }}" @endif required="">
          </div>
          <div class="form-group">
            <label for="shop_mobile">Shop Mobile</label>
            <input type="text" class="form-control" id="shop_mobile" placeholder="Enter 10 Digits Mobile Number" name="shop_mobile" @if(isset($vendorDetails['shop_mobile'])) value="{{ $vendorDetails['shop_mobile'] }}" @endif required="">
          </div>
          <div class="form-group">
            <label for="shop_country">Business License Number</label>
            <input type="text" class="form-control" id="business_license_number" placeholder="Enter Business License Number" name="business_license_number" @if(isset($vendorDetails['business_license_number'])) value="{{ $vendorDetails['business_license_number'] }}" @endif>
          </div>
          <div class="form-group">
            <label for="vat_number">VAT Number</label>
            <input type="text" class="form-control" id="vat_number" placeholder="Enter VAT Number" name="vat_number" @if(isset($vendorDetails['vat_number'])) value="{{ $vendorDetails['vat_number'] }}" @endif>
          </div>
          <div class="form-group">
            <label for="pan_number">PAN Number</label>
            <input type="text" class="form-control" id="pan_number" placeholder="Enter PAN Number" name="pan_number" @if(isset($vendorDetails['pan_number'])) value="{{ $vendorDetails['pan_number'] }}" @endif>
          </div>
          <div class="form-group">
            <label for="address_proof">Address Proof</label>
            <select class="form-control" name="address_proof" id="address_proof">
              <option value="Passport" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Passport" ) selected @endif>Passport</option>
              <option value="Citizenship Card" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Citizenship Card" ) selected @endif>Citizenship Card</option>
              <option value="PAN" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="PAN" ) selected @endif>PAN</option>
              <option value="Driving License" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Driving License" ) selected @endif>Driving License</option>
              <option value="Voting Card" @if(isset($vendorDetails['address_proof']) && $vendorDetails['address_proof']=="Voting Card" ) selected @endif>Voting Card</option>
            </select>
          </div>
          <div class="form-group">
            <label for="address_proof_image">Address Proof Photo</label>
            <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
            @if(!empty($vendorDetails['address_proof_image']))
            <a target="_blank" href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}">View Photo</a>
            <input type="hidden" name="current_address_proof" value="{{ $vendorDetails['address_proof_image'] }}">
            @endif
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <button type="reset" class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
@elseif($slug=="bank")
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Update Bank Information</h4>
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

        <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data">@csrf
          <div class="form-group">
            <label>Vendor Username/Email</label>
            <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
          </div>
          <div class="form-group">
            <label for="account_holder_name">Account Holder Name</label>
            <input type="text" class="form-control" id="account_holder_name" placeholder="Enter Account Holder Name" name="account_holder_name" @if(isset($vendorDetails['account_holder_name'])) value="{{ $vendorDetails['account_holder_name'] }}" @endif>
          </div>

          <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name" name="bank_name" @if(isset($vendorDetails['bank_name'])) value="{{ $vendorDetails['bank_name'] }}" @endif>
          </div>
          <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number" @if(isset($vendorDetails['account_number'])) value="{{ $vendorDetails['account_number'] }}" @endif>
          </div>
          <div class="form-group">
            <label for="bank_swift_code">Bank SWIFT Code</label>
            <input type="text" class="form-control" id="bank_swift_code" placeholder="Enter Bank SWIFT Code" name="bank_swift_code" @if(isset($vendorDetails['bank_swift_code'])) value="{{ $vendorDetails['bank_swift_code'] }}" @endif>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <button type="reset" class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endif
<!-- </div> -->
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<!-- @include('admin.layout.footer') -->
<!-- partial -->
<!-- </div> -->
@endsection