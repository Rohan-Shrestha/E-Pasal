@extends('front.layout.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style">
    <div class="container">
        <div class="page-intro">
            <!-- <h2>Payment</h2> -->
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home mr-2"></i>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="has-separator">
                    <a href="javascript:;">Payment</a>
                </li>
                <li class="is-marked">
                    <a href="#">Error</a>
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
            <div class="col-lg-12" align="center">
                <h3>YOUR PAYMENT HAS FAILED</h3>
                <p>Please try again after some time and If there is any query, you can contact us.</p>
            </div>
        </div>
    </div>
</div>
<!-- Cart-Page /- -->
@endsection