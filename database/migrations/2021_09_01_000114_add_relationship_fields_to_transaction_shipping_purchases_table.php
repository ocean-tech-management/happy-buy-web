<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionShippingPurchasesTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_shipping_purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4771411')->references('id')->on('users');
            $table->unsignedBigInteger('shipping_package_id')->nullable();
            $table->foreign('shipping_package_id', 'shipping_package_fk_4771426')->references('id')->on('shipping_packages');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_4771415')->references('id')->on('payment_methods');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id', 'admin_fk_4771419')->references('id')->on('admins');
        });
    }
}
