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
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(8)->get()->toArray();
        $bestSellers = Product::where(['is_bestseller'=>'Yes','status'=>1])->inRandomOrder()->get()->toArray();
        $discountedProducts = Product::where('product_discount','>',0)->where('status',1)->limit(8)->inRandomOrder()->get()->toArray();
        // dd($bestSellers);
        // dd($newProducts);
        // dd($discountedProducts);
        return view('front.index')->with(compact('sliderBanners','fixedBanners','newProducts','bestSellers','discountedProducts'));
    }
}
