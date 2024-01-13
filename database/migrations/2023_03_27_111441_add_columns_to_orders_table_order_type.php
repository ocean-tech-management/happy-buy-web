<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTableOrderType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_type')->after('collect_type')->nullable();
            $table->string('billing_name')->after('receiver_postcode')->nullable();
            $table->string('billing_phone')->after('billing_name')->nullable();
            $table->text('billing_address')->after('billing_phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_table_order_type', function (Blueprint $table) {
            //
        });
    }
}
