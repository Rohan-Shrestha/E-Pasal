<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->string('courier_name')->nullable()->after('item_status');
            $table->string('tracking_number')->nullable()->after('courier_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_products',function($table){
            $table->dropColumn('courier_name');
            $table->dropColumn('tracking_number');
        });
    }
};
