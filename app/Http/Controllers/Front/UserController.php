<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function userRegister(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make(
                $request->all(),
                [
                    "name" => "required|string|max:100",
                    "mobile" => "required|numeric|digits:10|unique:users",
                    "email" => "required|email|max:150|unique:users",
                    "password" => "required|min:6",
                    "accept" => "required",
                ],
                [
                    "accept.required" => "Please accept our Terms and Conditions"
                ]
            );

            if ($validator->passes()) {
                // Register the user
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();

                /* Activate the user account only when the user confirms his/her email account */
                $email = $data['email'];
                $messageData = ['name' => $data['name'], 'email' => $data['email'], 'code' => base64_encode($data['email'])];
                Mail::send('emails.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm your E-Pasal Account.');
                });

                // Redirect the user back with success message
                $redirectTo = url('user/login-register');
                return response()->json(['type' => 'success', 'url' => $redirectTo, 'message' => 'Please confirm your email to activate your account!']);

                /* Directly Activate the user without confirming his/her email account */

                // // Send Registration Email
                // $email = $data['email'];
                // $messageData = ['name'=>$data['name'], 'mobile'=>$data['mobile'], 'email'=>$data['email']];
                // Mail::send('emails.register',$messageData,function($message)use($email){
                //     $message->to($email)->subject('Welcome to E-Pasal');
                // });

                // if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]))
                // {
                //     $redirectTo = url('cart');

                //     // Update User Cart with user id
                //     if(!empty(Session::get('session_id'))){
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                //     }

                //     return response()->json(['type'=>'success','url'=>$redirectTo]);
                // }


            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        }
    }

    public function userAccount(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make(
                $request->all(),
                [
                    "name" => "required|string|max:100",
                    "address" => "required|string|max:100",
                    "city" => "required|string|max:100",
                    "province" => "required|string|max:100",
                    "country" => "required|string|max:100",
                    "pincode" => "required|digits:5",
                    "mobile" => "required|numeric|digits:10",
                ]
            );

            if($validator->passes()){
                // Update User Details
                User::where('id', Auth::user()->id)->update(['name'=>$data['name'], 'address'=>$data['address'], 'city'=>$data['city'], 'province'=>$data['province'], 'country'=>$data['country'], 'pincode'=>$data['pincode'], 'mobile'=>$data['mobile']]);

                // Redirect user back with success message
                $redirectTo = url('user/account');
                return response()->json(['type'=>'success', 'message'=>'Your account details has been updated successfully!']);
            } else {
                return response()->json(['type'=>'error', 'errors'=>$validator->messages()]);
            }
        } else {
            $countries = Country::where('status', 1)->get()->toArray();
            return view('front.users.user_account')->with(compact('countries'));
        }
    }

    public function userUpdatePassword(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make(
                $request->all(),
                [
                    "current_password" => "required",
                    "new_password" => "required|min:6",
                    "confirm_password" => "required|min:6|same:new_password"
                ]
            );

            if($validator->passes()){

                $current_password = $data['current_password'];
                $checkPassword = User::where('id', Auth::user()->id)->first();
                if(Hash::check($current_password, $checkPassword->password)){
                    // Update Current Password of the customer/user
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                    // Redirect user back with success message
                    return response()->json(['type'=>'success', 'message'=>'Your Account Password has been updated successfully!']);
                } else {
                    // Redirect user back with error message
                    return response()->json(['type'=>'incorrect', 'message'=>'Your current password is incorrect!']);
                }

                // Redirect user back with success message
                return response()->json(['type'=>'success', 'message'=>'Your account details has been updated successfully!']);
            } else {
                return response()->json(['type'=>'error', 'errors'=>$validator->messages()]);
            }
        } else {
            $countries = Country::where('status', 1)->get()->toArray();
            return view('front.users.user_account')->with(compact('countries'));
        }
    }

    public function forgotPassword(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make(
                $request->all(),
                [
                    "email" => "required|email|max:150|exists:users",
                ],
                [
                    "email.exists" => "Email doesn't exist! Please provide your registered email."
                ]
            );

            if($validator->passes()){
                // $userDetails = User::where('email', $data['email'])->first();
                // Generate New Password
                $new_password = Str::random(16);

                // Update New Password
                User::where('email', $data['email'])->update(['password'=>bcrypt($new_password)]);

                // Get User Details
                $userDetails = User::where('email', $data['email'])->first()->toArray();

                // Send Email to User about Password Changed
                $email = $data['email'];
                $messageData = ['name' => $userDetails['name'], 'email' => $email, 'password' => $new_password];
                Mail::send('emails.user_forgot_password', $messageData, function($message)use($email){
                    $message->to($email)->subject('New Password. E-Pasal');
                });

                // Show success message
                return response()->json(['type'=>'success', 'message'=>'New Password sent to your registered email.']);
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        } else {
            return view('front.users.forgot_password');
        }
    }

    public function userLogin(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                "email" => "required|email|max:150|exists:users",
                "password" => "required|min:6",
            ]);

            if ($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    if (Auth::user()->status == 0) {
                        Auth::logout();
                        return response()->json(['type' => 'inactive', 'message' => 'Account not active! Please confirm your email to activate your account.']);
                    }

                    // Update User Cart with user id
                    if (!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }

                    $redirectTo = url('cart');
                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                } else {
                    return response()->json(['type' => 'incorrect', 'message' => 'Incorrect Email or Password!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        }
    }

    public function confirmAccount($code)
    {
        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) 
        {
            $userDetails = User::where('email', $email)->first();

            // if the user account is already activated
            if($userDetails->status==1)
            {
                // Redirect the user to Login/Register Page with error message
                return redirect('user/login-register')->with('error_message','Your epasal account is already activated. You may Login now.');
            } else {
                User::where('email', $email)->update(['status'=>1]);
                // Send welcome Email to the user
                $messageData = [
                    'name'=>$userDetails->name,
                    'mobile'=>$userDetails->mobile,
                    'email'=>$email
                ];
                Mail::send('emails.register',$messageData,function($message)use($email){
                    $message->to($email)->subject('Welcome to E-Pasal');
                });

                // Redirect the user to Login/Register Page with success message
                return redirect('user/login-register')->with('success_message','Your epasal account has been activated. You may Login now.');
            }
        } else {
            abort(404);
        }
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
