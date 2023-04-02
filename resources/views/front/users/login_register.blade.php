@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="account.html">Account</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Account-Page -->
<div class="page-account u-s-p-t-80">
    <div class="container">
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success: </strong>{{ Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <li>{{ Session::get('error_message')}}</li>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo implode('', $errors->all('<div>! :message</div>')); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <!-- Login -->
            <div class="col-lg-6">
                <div class="login-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Login</h2>
                    <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                    <form action="{{ url('admin/login') }}" method="post">@csrf
                        <div class="u-s-m-b-30">
                            <label for="user-email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="user-email" class="text-field" placeholder="Email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-password">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" name="password" id="user-password" class="text-field" placeholder="Password">
                        </div>
                        <!-- <div class="group-inline u-s-m-b-30">
                            <div class="group-1">
                                <input type="checkbox" class="check-box" id="remember-me-token">
                                <label class="label-text" for="remember-me-token">Remember me</label>
                            </div>
                            <div class="group-2 text-right">
                                <div class="page-anchor">
                                    <a href="lost-password.html">
                                        <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login /- -->
            <!-- Register -->
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Register</h2>
                    <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status and history.</h6>
                    <form id="userForm" action="{{ url('/user/register') }}" method="post">@csrf
                        <div class="u-s-m-b-30">
                            <label for="username">Name
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="username" name="name" class="text-field" placeholder="Enter User Name">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="usermobile">Moblie
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="usermobile" name="mobile" class="text-field" placeholder="Enter Moblie Number">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="useremail">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" id="useremail" name="email" class="text-field" placeholder="Enter User Email">
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="userpassword">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="userpassword" name="password" class="text-field" placeholder="Enter User Password">
                        </div>
                        <div class="u-s-m-b-30">
                            <input type="checkbox" class="check-box" id="accept" name="accept">
                            <label class="label-text no-color" for="accept">I’ve read and accept the
                                <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                            </label>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register /- -->
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection