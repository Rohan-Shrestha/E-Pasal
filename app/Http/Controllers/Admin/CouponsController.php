<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponsController extends Controller
{
    public function coupons()
    {
        Session::put('page','coupons');
        $coupons = Coupon::get()->toArray();
        // dd($coupons);
        return view('admin.coupons.coupons')->with(compact('coupons'));
    }

    public function updateCouponStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'coupon_id'=>$data['coupon_id']]);
        }
    }

    public function deleteCoupon($id){
        // Delete Coupon
        Coupon::where('id', $id)->delete();
        $message = "Coupon has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function addEditCoupon(Request $request, $id=null)
    {
        if($id=="")
        {
            // Add Coupon
            $title = "Add Coupon";
            $coupon = new Coupon;
            $message = "Coupon added successfully!";
        } else {
            // Update Coupon
            $title = "Edit Coupon";
            $coupon = Coupon::find($id);
            $message = "Coupon updated successfully!";
        }

        return view('admin.coupons.add_edit_coupon')->with(compact('title', 'coupon'));
    }
}
