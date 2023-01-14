<?php

namespace App\Http\Controllers\Admin;
//use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(){
        //echo $password = Hash::make('123456'); die;
        return view('admin.login');
    }
}
