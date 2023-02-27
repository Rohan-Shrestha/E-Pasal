<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with(['section','parentCategory'])->get()->toArray();
        // dd($categories);
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null)
    {
        Session::put('page', 'categories');
        if($id==""){
            // Add Category
            $title = "Add Category";
            $category = new Category;
            $message = "Category added successfully!";
        }else{
            // Edit Category
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Category Photo
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/category_images/' . $imageName;
                    // Upload the image
                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imageName;
                }
            }else {
                $category->category_image = "";
            }

            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('success_message',$message);
        }

        // Get All Sections
        $getSections = Section::get()->toArray();

        return view('admin.categories.add_edit_category')->with(compact('title', 'category', 'getSections'));

        // if($request->isMethod('post')){
        //     $data = $request->all();
        //     // echo "<pre>"; print_r($data); die;
        //     $rules = [
        //         'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
        //     ];

        //     $customMessages = [
        //         'category_name.required' => 'Please fill out the Category Name.',
        //         'category_name.regex' => 'The category name must be valid.',
        //     ];

        //     $this->validate($request, $rules, $customMessages);

        //     $category->name = $data['category_name'];
        //     $category->status = 1;
        //     $category->save();
        //     return redirect('admin/categories')->with('success_message', $message);

        // }

        // return view('admin.categories.add_edit_categories')->with(compact('title', 'category'));
    }
}
