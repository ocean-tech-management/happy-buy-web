<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4626273')->references('id')->on('users');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_4626346')->references('id')->on('payment_methods');
            $table->unsignedBigInteger('pickup_location_id')->nullable();
            $table->foreign('pickup_location_id', 'pickup_location_fk_4852333')->references('id')->on('pick_up_locations');
            $table->unsignedBigInteger('shipped_by_id')->nullable();
            $table->foreign('shipped_by_id', 'shipped_by_fk_4673106')->references('id')->on('admins');
            $table->unsignedBigInteger('picked_up_by_id')->nullable();
            $table->foreign('picked_up_by_id', 'picked_up_by_fk_4673107')->references('id')->on('admins');
            $table->unsignedBigInteger('completed_by_id')->nullable();
            $table->foreign('completed_by_id', 'completed_by_fk_4673108')->references('id')->on('admins');
            $table->unsignedBigInteger('refund_by_id')->nullable();
            $table->foreign('refund_by_id', 'refund_by_fk_4673109')->references('id')->on('admins');
            $table->unsignedBigInteger('shipping_company_id')->nullable();
            $table->foreign('shipping_company_id', 'shipping_company_fk_4673110')->references('id')->on('shipping_companies');
            $table->unsignedBigInteger('invoice_user_id')->nullable();
            $table->foreign('invoice_user_id', 'invoice_user_fk_4869950')->references('id')->on('users');
            $table->unsignedBigInteger('order_user_id')->nullable();
            $table->foreign('order_user_id', 'order_user_fk_4869950')->references('id')->on('users');
        });
    }
}
