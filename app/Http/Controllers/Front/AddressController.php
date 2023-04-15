<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $address = DeliveryAddress::where('id', $data['addressid'])->first()->toArray();
            return response()->json(['address'=>$address]);
        }
    }
}
