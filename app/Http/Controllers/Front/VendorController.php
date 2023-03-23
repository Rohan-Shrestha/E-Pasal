<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function loginRegister()
    {
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request)
    {
        if ($request->isMethod('post')) {
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
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();

            // Create Vendor Account

            // Insert the Vendors details in the vendors table
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->status = 0;

            // Set Default Time Zone to Nepal
            date_default_timezone_set("Asia/Kathmandu");
            $vendor->created_at = date("Y-m-d H:i:s");
            $vendor->updated_at = date("Y-m-d H:i:s");
            $vendor->save();

            $vendor_id = DB::getPdo()->lastInsertId();

            // Insert the Vendors details in the admins table
            $admin = new Admin;
            $admin->type = 'vendor';
            $admin->vendor_id = $vendor_id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0;
            // Set Default Time Zone to Nepal
            date_default_timezone_set("Asia/Kathmandu");
            $admin->created_at = date("Y-m-d H:i:s");
            $admin->updated_at = date("Y-m-d H:i:s");
            $admin->save();

            // Send Confirmation email to vendor
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'name' => $data['name'],
                'code' => base64_encode($data['email'])
            ];

            Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Confirm your Vendor Email');
            });

            DB::commit();

            // Redirect Vendor back with success message
            $message = "Thank You for registering as Vendor. Please confirm your email to confirm it is really you.";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function confirmVendor($email)
    {
        // Decode Vendor Email
        $email = base64_decode($email);

        // Check if Vendor email exists or not
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) {
            // Either Vendor Email is already activated or not
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == "Yes") {
                $message = "Your Vendor Email has been confirmed already. You may Login.";
                return redirect('vendor/login-register')->with('error_message', $message);
            } else {
                // Update "confirm" column to "Yes" in both "admin" and "vendors" table for account activation.
                Admin::where('email', $email)->update(['confirm' => "Yes"]);
                Vendor::where('email', $email)->update(['confirm' => "Yes"]);

                // Send Register Email
                $messageData = [
                    'email' => $email,
                    'name' => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile
                ];

                Mail::send('emails.vendor_confirmed', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Your Vendor Email has been confirmed.');
                });

                // Redirect to Vendor Login/Register Page with Success message.
                $message = "Your Vendor Email has been confirmed. You can login and add your personal, 
                business and bank details to add your products in the EPasal Store.";
                return redirect('vendor/login-register')->with('success_message', $message);
            }
        } else {
            abort(404);
        }
    }
}
