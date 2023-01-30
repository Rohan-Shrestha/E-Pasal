<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // password has the encrypted form of 123456 from bcrypt-generator
        $adminRecords = [
            ['id'=>2, 'name'=>'John', 'type'=>'vendor', 'vendor_id'=>1, 'mobile'=>'9700000000',
            'email'=>'john@admin.com', 'password'=>'$2a$12$ZF9RRjZR.64cHjCC9Ex8aeinPwXtf.b5kgS0XTNOdM8FMRuW6rXVK', 'image'=>'', 'status'=>0],
        ];
        Admin::insert($adminRecords);
    }
}
