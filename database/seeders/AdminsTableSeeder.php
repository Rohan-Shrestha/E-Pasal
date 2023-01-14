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
            ['id'=>1, 'name'=>'Super Admin', 'type'=>'superadmin', 'vendor_id'=>0, 'mobile'=>'9800000000',
            'email'=>'admin@admin.com', 'password'=>'$2a$12$ZF9RRjZR.64cHjCC9Ex8aeinPwXtf.b5kgS0XTNOdM8FMRuW6rXVK', 'image'=>'', 'status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
