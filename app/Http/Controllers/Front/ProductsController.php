<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class ProductsController extends Controller
{
    public function listing(){
        // echo $url = Route::getFacadeRoot()->current()->uri(); die;
        $url = Route::getFacadeRoot()->current()->uri();
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
        if($categoryCount>0){
            // Getting Category Details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);
            $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetails['catIds'])->where('status',1)->Paginate(3);
            // dd($categoryProducts);
            // echo "Category exists"; die;
            return view('front.products.listing')->with(compact('categoryDetails','categoryProducts'));
        }else{
            abort(404);
        }
    }
}
