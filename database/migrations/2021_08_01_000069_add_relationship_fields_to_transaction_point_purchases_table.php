<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionPointPurchasesTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_point_purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4498957')->references('id')->on('users');
            $table->unsignedBigInteger('point_package_id')->nullable();
            $table->foreign('point_package_id', 'point_package_fk_4498958')->references('id')->on('point_packages');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_4498961')->references('id')->on('payment_methods');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id', 'admin_fk_4498965')->references('id')->on('admins');
        });
    }
}
