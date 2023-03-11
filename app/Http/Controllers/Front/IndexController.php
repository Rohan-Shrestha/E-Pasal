<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(){
        $sliderBanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $fixedBanners = Banner::where('type','Fixed')->where('status',1)->get()->toArray();
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(6)->get()->toArray();
        // dd($newProducts);
        return view('front.index')->with(compact('sliderBanners','fixedBanners','newProducts'));
    }
}
