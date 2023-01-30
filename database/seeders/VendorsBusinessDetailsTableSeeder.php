<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBusinessDetails;

class VendorsBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>1, 'vendor_id'=>1, 'shop_name'=>'John Electronics Store', 'shop_address'=>'Putalisadak', 'shop_city'=>'Kathmandu', 'shop_province'=>'Bagmati', 
            'shop_country'=>'Nepal', 'shop_pincode'=>'44600', 'shop_mobile'=>'9700000000', 'shop_website'=>'newegg.com', 'shop_email'=>'john@admin.com', 'address_proof'=>'Passport', 
            'address_proof_image'=>'test.jpg', 'business_license_number'=>'122334455', 'vat_number'=>'234345456', 'pan_number'=>'345456567'],
        ];
        VendorsBusinessDetails::insert($vendorRecords);
    }
}
