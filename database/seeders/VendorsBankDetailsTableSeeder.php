<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorsBankDetails;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>1, 'vendor_id'=>1, 'account_holder_name'=>'John Doe', 'bank_name'=>'NIC ASIA Bank Ltd.', 
            'account_number'=>'0123450000123456', 'bank_swift_code'=>'NICENPKA001'],
        ];
        VendorsBankDetails::insert($vendorRecords);
    }
}
