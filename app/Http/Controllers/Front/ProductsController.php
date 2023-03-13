<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
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
            dd($categoryDetails);
            echo "Category exists"; die;
        }else{
            abort(404);
        }
    }
}
