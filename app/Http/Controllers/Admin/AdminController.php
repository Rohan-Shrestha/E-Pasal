<?php

namespace App\Http\Controllers\Admin;
//use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBankDetails;
use App\Models\VendorsBusinessDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Check if current password entered by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // Check if new password is matching with confirm password
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New password and Confirm Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is Incorrect!');
            }
        }

        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric|digits:10',
            ];

            $customMessages = [
                'admin_name.required' => 'Please fill out the Name field.',
                'admin_name.regex' => 'The name must be valid.',
                'admin_mobile.required' => 'Please fill out the Mobile field',
                'admin_mobile.numeric' => 'The mobile number must be valid.',
                'admin_mobile.digits' => 'The mobile number must be 10 digits.',
            ];

            $this->validate($request, $rules, $customMessages);

            // Upload admin image/photo
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/photos/' . $imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }

            // Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);
            return redirect()->back()->with('success_message', 'Admin details updated successfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request)
    {
        if ($slug == "personal") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric|digits:10',
                ];

                $customMessages = [
                    'vendor_name.required' => 'Please fill out the Name field.',
                    'vendor_city.required' => 'Please fill out the City field.',
                    'vendor_name.regex' => 'The name must be valid.',
                    'vendor_city.regex' => 'The city must be valid.',
                    'vendor_mobile.required' => 'Please fill out the Mobile field',
                    'vendor_mobile.numeric' => 'The mobile number must be valid.',
                    'vendor_mobile.digits' => 'The mobile number must be 10 digits.',
                ];

                $this->validate($request, $rules, $customMessages);

                // Upload admin image/photo
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;
                        // Upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }

                // Update in admins table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'image' => $imageName]);

                // Update in vendors table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['vendor_name'],
                    'address' => $data['vendor_address'], 'city' => $data['vendor_city'], 'province' => $data['vendor_province'],
                    'country' => $data['vendor_country'], 'pincode' => $data['vendor_pincode'], 'mobile' => $data['vendor_mobile']
                ]);
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "business") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric|digits:10',
                    'address_proof' => 'required',
                    // 'address_proof_image' => 'required|image',
                ];

                $customMessages = [
                    'shop_name.required' => 'Please fill out the Name field.',
                    'shop_city.required' => 'Please fill out the City field.',
                    'shop_name.regex' => 'The name must be valid.',
                    'shop_city.regex' => 'The city must be valid.',
                    'shop_mobile.required' => 'Please fill out the Mobile field',
                    'shop_mobile.numeric' => 'The mobile number must be valid.',
                    'shop_mobile.digits' => 'The mobile number must be 10 digits.',
                    'address_proof.required' => 'Please provide address proof category.',
                    // 'address_proof_image.image' => 'The address proof photo must be valid.',
                ];

                $this->validate($request, $rules, $customMessages);

                // Upload admin image/photo
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        // Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // Generate New Image Name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/proofs/' . $imageName;
                        // Upload the image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof'])) {
                    $imageName = $data['current_address_proof'];
                } else {
                    $imageName = "";
                }

                // Update in vendors_business_details table
                VendorsBusinessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'shop_name' => $data['shop_name'],
                    'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_province' => $data['shop_province'],
                    'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'shop_mobile' => $data['shop_mobile'], 
                    'business_license_number' => $data['business_license_number'], 'vat_number' => $data['vat_number'], 'pan_number' => $data['pan_number'], 
                    'address_proof' => $data['address_proof'], 'address_proof_image' => $imageName
                ]);
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorDetails = VendorsBusinessDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            // dd($vendorDetails);
        } else if ($slug == "bank") {
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric|digits:16',
                    'bank_swift_code' => 'required|alpha_num:ascii',
                ];

                $customMessages = [
                    'account_holder_name.required' => 'Please fill out the account holder name.',
                    'account_holder_name.regex' => 'The account holder name must be valid.',
                    'bank_name.required' => 'Please fill out the bank name.',
                    'account_number.required' => 'Please fill out the account number.',
                    'account_number.numeric' => 'The account number must be valid.',
                    'account_number.digits' => 'The account number must be 16 digits.',
                    'bank_swift_code.required' => 'Please fill out the bank swift code.',
                ];

                $this->validate($request, $rules, $customMessages);

                // Update in vendors_bank_details table
                VendorsBankDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'],
                    'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 
                    'bank_swift_code' => $data['bank_swift_code'],
                ]);
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorDetails = VendorsBankDetails::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails'));
    }

    public function login(Request $request)
    {
        //echo $password = Hash::make('123456'); die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                // Add Custom Messages here
                'email.required' => 'The email address is required',
                'email.email' => 'The email must be a valid email address.',
                'password.required' => 'The password field is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect('admin/dashboard');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function admins($type=null){
        $admins = Admin::query();
        if(!empty($type)){
            $admins = $admins->where('type', $type);
            $title = ucfirst($type)."s";
        }else{
            $title = "All Admins/Subadmins/Vendors";
        }
        $admins = $admins->get()->toArray();
        // dd($admins);
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }

    public function viewVendorDetails($id){
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        // dd($vendorDetails);
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
