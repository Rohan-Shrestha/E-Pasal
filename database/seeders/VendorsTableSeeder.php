<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>1, 'name'=>'John', 'address'=>'New Road', 'city'=>'Kathmandu', 'province'=>'Bagmati', 
            'country'=>'Nepal', 'pincode'=>'44600', 'mobile'=>'9700000000', 'email'=>'john@admin.com', 'status'=>0],
        ];
        Vendor::insert($vendorRecords);
    }
}
