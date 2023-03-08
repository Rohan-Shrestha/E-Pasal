<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $sliderBanners = Banner::where('type','Slider')->where('status',1)->get()->toArray();
        $fixedBanners = Banner::where('type','Fixed')->where('status',1)->get()->toArray();
        return view('front.index')->with(compact('sliderBanners','fixedBanners'));
    }
}
