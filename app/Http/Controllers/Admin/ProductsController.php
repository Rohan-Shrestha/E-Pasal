<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page', 'products');
        $products = Product::with(['section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        // dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        # Delete product
        Product::where('id',$id)->delete();
        $message = "Product has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function addEditProduct(Request $request, $id=null)
    {
        Session::put('page', 'products');
        if($id==""){
            $title = "Add Product";
            $product = new Product;
            $message = "Product Added Successfully!";
        }else{
            $title = "Edit Product";
            $product = Product::find($id);
            // dd($product);
            // echo "<pre>"; print_r($product); die;
            $message = "Product Updated Successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;

            // Products form validations
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessages = [
                'category_id.required' => 'Please select the Category.',
                'product_name.required' => 'Please fill out the Product Name.',
                'product_name.regex' => 'The product name must be valid.',
                'product_code.required' => 'Please fill out the Product Code.',
                'product_code.regex' => 'The product code must be valid.',
                'product_price.required' => 'Please fill out the Product Price.',
                'product_price.numeric' => 'The product price must be valid.',
                'product_color.required' => 'Please fill out the Product Color.',
                'product_color.regex' => 'The product color must be valid.',
            ];

            $this->validate($request, $rules, $customMessages);

            // Upload Product Image after Resizing it. small: 250x250, medium: 500x500, large: 1000x1000
            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'front/images/product_images/large/'.$imageName;
                    $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                    $smallImagePath = 'front/images/product_images/small/'.$imageName;
                    // Upload the Large, Medium and Small Images after resize
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    // Insert Image Name in products table
                    $product->product_image = $imageName;
                }
            }

            // Upload Product Video
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                    // Upload Video in videos folder
                    // $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    // $videoName = $video_name.'-'.rand().'.'.$extension;
                    $videoName = rand(111, 99999).'.'.$extension;
                    $videoPath = 'front/videos/product_videos/';
                    $video_tmp->move($videoPath,$videoName);
                    // Insert Video Name in Products Table
                    $product->product_video = $videoName;
                }
            }

            // Save Product Details in produts table
            $categoryDetails = Category::find($data['category_id']);
            // echo "<pre>"; print_r($categoryDetails); die;
            // dd($categoryDetails);
            // dd($categoryDetails['section_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;

            if($adminType=="vendor"){
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }

            if(empty($data['product_discount'])){
                $data['product_discount'] = 0;
            }

            if(empty($data['product_weight'])){
                $data['product_weight'] = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];

            if(!empty($data['is_featured'])){
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            
            if(!empty($data['is_bestseller'])){
                $product->is_bestseller = $data['is_bestseller'];
            }else{
                $product->is_bestseller = "No";
            }

            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message',$message);
        }

        // Get Sections with Categories and Sub Categories
        $categories = Section::with('categories')->get()->toArray();
        // dd($categories);
        
        // Get All Brands
        $brands = Brand::where('status',1)->get()->toArray();

        return view('admin.products.add_edit_product')->with(compact('title','categories','brands','product'));
    }

    public function deleteProductImage($id)
    {
        // Get Product Image from the product model
        $productImage = Product::select('product_image')->where('id',$id)->first();

        // Get Product Image Paths
        $small_image_path = 'front/images/product_images/small/';
        $medium_image_path = 'front/images/product_images/medium/';
        $large_image_path = 'front/images/product_images/large/';

        // Delete small image of product, if it exists in "small" folder
        if(file_exists($small_image_path.$productImage->product_image)){
            unlink($small_image_path.$productImage->product_image);
        }

        // Delete medium sized image of product, if it exists in "medium" folder
        if(file_exists($medium_image_path.$productImage->product_image)){
            unlink($medium_image_path.$productImage->product_image);
        }

        // Delete large sized image of product, if it exists in the folder named as large
        if(file_exists($large_image_path.$productImage->product_image)){
            unlink($large_image_path.$productImage->product_image);
        }

        // Delete Product Image from "products" table
        Product::where('id',$id)->update(['product_image'=>'']);

        $message = "Product's Photos has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function deleteProductVideo($id)
    {
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id',$id)->first();

        // Get Product Video Path
        $product_video_path = 'front/videos/product_videos/';

        // Delete Product's Video from "product_videos" folder if video exists
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }

        // Delete Product Video Image from products table
        Product::where('id',$id)->update(['product_video'=>'']);

        $message = "Product's Video has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function addImages(Request $request, $id){
        Session::put('page', 'products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_image')->with('images')->find($id);
        // $product = json_decode(json_encode($product),true);
        // dd($product);

        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('images')){
                $images = $request->file('images');
                // echo "<pre>"; print_r($images); die;

                foreach ($images as $key => $image) {

                    // Generate Temporary Image Name
                    $image_tmp = Image::make($image);
                    // Get Image Name
                    $image_name = $image->getClientOriginalName();
                    // Get Image Extension
                    $extension = $image->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = $image_name.rand(111, 99999) . '.' . $extension;
                    $largeImagePath = 'front/images/product_images/large/'.$imageName;
                    $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                    $smallImagePath = 'front/images/product_images/small/'.$imageName;
                    // Upload the Large, Medium and Small Images after resize
                    Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                    // Insert Image Name in products table
                    $image = new ProductsImage;
                    $image->image = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }

            return redirect()->back()->with('success_message','Product Photos has been added successfully!');
        }

        return view('admin.images.add_images')->with(compact('product'));
    }

    public function updateImageStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'image_id'=>$data['image_id']]);
        }
    }

    public function deleteImage($id)
    {
        // Get Product Image from the product model
        $productImage = ProductsImage::select('image')->where('id',$id)->first();

        // Get Product Image Paths
        $small_image_path = 'front/images/product_images/small/';
        $medium_image_path = 'front/images/product_images/medium/';
        $large_image_path = 'front/images/product_images/large/';

        // Delete small image of product, if it exists in "small" folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Delete medium sized image of product, if it exists in "medium" folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete large sized image of product, if it exists in the folder named as large
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Product Image from "products_images" table
        ProductsImage::where('id',$id)->delete();

        $message = "Product's Photo has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
