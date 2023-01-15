@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Settings</h3>
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
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Update Admin Details</h4>
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

            <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="post">@csrf
              <div class="form-group">
                <label>Admin Username/Email</label>
                <input class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
              </div>
              <div class="form-group">
                <label>Admin Type</label>
                <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly="">
              </div>
              <div class="form-group">
                <label for="admin_name">Name</label>
                <input type="text" class="form-control" id="admin_name" placeholder="Enter Full Name" name="admin_name" value="{{ Auth::guard('admin')->user()->name }}" required="">
              </div>
              <div class="form-group">
                <label for="admin_mobile">Mobile</label>
                <input type="text" class="form-control" id="admin_mobile" placeholder="Enter 10 Digits Mobile Number" name="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" required="">
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button class="btn btn-light">Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  @include('admin.layout.footer')
  <!-- partial -->
</div>
@endsection