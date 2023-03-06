<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributesController extends Controller
{
    public function addAttributes(Request $request, $id){
        Session::put('page', 'products');
        $product = Product::select(
            'id',
            'product_name',
            'product_code',
            'product_color',
            'product_price',
            'product_image'
        )->with('attributes')->find($id);
        // $product = json_decode(json_encode($product),true);
        // dd($product);

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data); die;

            foreach ($data['sku'] as $key => $value) {
                if(!empty($value)){

                    // Duplicate SKU check
                    $skuCount = ProductsAttribute::where('sku',$value)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('error_message','SKU already exists! Please enter a new SKU.');
                    }

                    // Duplicate Size check
                    $sizeCount = ProductsAttribute::where(['product_id'=>$id],'size',$data['size'][$key])->count();
                    if($sizeCount>0){
                        return redirect()->back()->with('error_message','Size already exists! Please enter a new Size.');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            return redirect()->back()->with('success_message','Product Attributes has been added successfully!');
        }
        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }

    public function updateAttributeStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function editAttributes(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['attributeId'] as $key => $attribute) {
                if(!empty($attribute)){
                    ProductsAttribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message','Product Attributes has been updated successfully!');
        }
    }

    // public function deleteProduct($id)
    // {
    //     # Delete product
    //     Product::where('id',$id)->delete();
    //     $message = "Product has been deleted successfully!";
    //     return redirect()->back()->with('success_message',$message);
    // }
}
