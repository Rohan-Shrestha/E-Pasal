<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function userRegister(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(),
                [
                    "name" => "required|string|max:100",
                    "mobile" => "required|numeric|digits:10",
                    "email" => "required|email|max:150|unique:users",
                    "password" => "required|min:6",
                    "accept" => "required",
                ],
                [
                    "accept.required" => "Please accept our Terms and Conditions"
                ]
            );

            if($validator->passes()){
                // Register the user
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();

                // Send Registration Email
                $email = $data['email'];
                $messageData = ['name'=>$data['name'], 'mobile'=>$data['mobile'], 'email'=>$data['email']];
                Mail::send('emails.register',$messageData,function($message)use($email){
                    $message->to($email)->subject('Welcome to E-Pasal');
                });

                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]))
                {
                    $redirectTo = url('cart');

                    // Update User Cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }

                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function userLogin(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make($request->all(), [
                    "email" => "required|email|max:150|exists:users",
                    "password" => "required|min:6",
            ]);

            if($validator->passes()){
                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']]))
                {
                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['type'=>'inactive', 'message'=>'Your account is inactive. Please contact us through email.']);
                    }

                    // Update User Cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }

                    $redirectTo = url('cart');
                    return response()->json(['type'=>'success','url'=>$redirectTo]);
                }else {
                    return response()->json(['type'=>'incorrect', 'message'=>'Incorrect Email or Password!']);
                }
            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
