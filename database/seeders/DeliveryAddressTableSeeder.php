<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            ["id"=>1, "user_id"=>1, "name"=>"Ramesh Shrestha", "address"=>"Arjundhara-6", "city"=>"Birtamode", "province"=>"Province 1", "country"=>"Nepal", "pincode"=>57204, "mobile"=>9818253000, "status"=>1],
            ["id"=>2, "user_id"=>1, "name"=>"Ramesh Shrestha", "address"=>"Dillibazaar", "city"=>"Kathmandu", "province"=>"Bagmati", "country"=>"Nepal", "pincode"=>44600, "mobile"=>9818253000, "status"=>1]
        ];

        DeliveryAddress::insert($deliveryRecords);
    }
}
