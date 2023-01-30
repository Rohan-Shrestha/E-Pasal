<?php

namespace App\Http\Controllers\Admin;
//use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Check if current password entered by admin is correct
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                // Check if new password is matching with confirm password
                if($data['new_password']==$data['confirm_password']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message','Password has been updated successfully!');
                }else{
                    return redirect()->back()->with('error_message','New password and Confirm Password does not match!');
                }
            }else{
                return redirect()->back()->with('error_message','Your current password is Incorrect!');
            }
        }

        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
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
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_admin_image'])){
                $imageName = $data['current_admin_image'];
            }else{
                $imageName = "";
            }

            // Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile'], 'image'=>$imageName]);
            return redirect()->back()->with('success_message', 'Admin details updated successfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request){
        if($slug=="personal"){
            if($request->isMethod('post')){
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
            if($request->hasFile('vendor_image')){
                $image_tmp = $request->file('vendor_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_vendor_image'])){
                $imageName = $data['current_vendor_image'];
            }else{
                $imageName = "";
            }

            // Update in admins table
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);

            // Update in vendors table
            Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'], 
            'address'=>$data['vendor_address'], 'city'=>$data['vendor_city'], 'province'=>$data['vendor_province'], 
            'country'=>$data['vendor_country'], 'pincode'=>$data['vendor_pincode'], 'mobile'=>$data['vendor_mobile']]);
            return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        else if($slug=="business"){}
        else if($slug=="bank"){}
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails'));
    }

    public function login(Request $request){
        //echo $password = Hash::make('123456'); die;

        if($request->isMethod('post')){
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

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                return redirect('admin/dashboard');
            }
            else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
