<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $deliveryAddress = DeliveryAddress::where('id', $data['addressid'])->first()->toArray();
            return response()->json(['address' => $deliveryAddress]);
        }
    }

    public function saveDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $validator = Validator::make(
                $request->all(),
                [
                    "delivery_name" => "required|string|max:100",
                    "delivery_address" => "required|string|max:100",
                    "delivery_city" => "required|string|max:100",
                    "delivery_province" => "required|string|max:100",
                    "delivery_country" => "required|string|max:100",
                    "delivery_pincode" => "required|digits:5",
                    "delivery_mobile" => "required|numeric|digits:10",
                ],
                [
                    "delivery_mobile.required" => "The delivery phone number field is required.",
                    "delivery_mobile.numeric" => "The delivery phone number must be numbers.",
                    "delivery_mobile.digits" => "The delivery phone number must be 10 digits."
                ]
            );

            if ($validator->passes()) {
                $address = array();
                $address['user_id'] = Auth::user()->id;
                $address['name'] = $data['delivery_name'];
                $address['address'] = $data['delivery_address'];
                $address['city'] = $data['delivery_city'];
                $address['province'] = $data['delivery_province'];
                $address['country'] = $data['delivery_country'];
                $address['pincode'] = $data['delivery_pincode'];
                $address['mobile'] = $data['delivery_mobile'];
                if (!empty($data['delivery_id'])) {
                    // Edit Delivery Address
                    DeliveryAddress::where('id', $data['delivery_id'])->update($address);
                } else {
                    $address['status'] = 1;
                    // Add New Delivery Address
                    DeliveryAddress::create($address);
                }

                $deliveryAddresses = DeliveryAddress::deliveryAddresses();
                $countries = Country::where('status', 1)->get()->toArray();
                return response()->json([
                    'view' => (string)View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses', 'countries'))
                ]);
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->messages()]);
            }
        }
    }

    public function removeDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            DeliveryAddress::where('id', $data['addressid'])->delete();
            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
            $countries = Country::where('status', 1)->get()->toArray();
            return response()->json([
                'view' => (string)View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses', 'countries'))
            ]);
        }
    }
}
