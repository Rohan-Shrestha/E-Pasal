<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function loginRegister(){
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Validate Vendor Registration
            $rules = [
                "name" => "required",
                "email" => "required|email|unique:admins|unique:vendors", 
                "mobile" => "required|numeric|digits:10|unique:admins|unique:vendors",
                'password' => 'required',
                "accept" => "required",
            ];

            $customMessages = [
                "name.required" => "Please fill out the Name field.",
                "email.required" => "Please fill out the Email field.",
                "email.unique" => "The email already exists! Please enter a new email.",
                "mobile.required" => "Please fill out the Mobile field.",
                "mobile.unique" => "The number already exists! Please enter a new number.",
                'password.required' => 'Please fill out the password field.',
                "accept.required" => "Please read and accept the terms and conditions.",
            ];
            $validator = Validator::make($data, $rules, $customMessages);
            if($validator->fails()){
                return Redirect::back()->withErrors($validator);
            }
        }
    }
}
