<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionRedeemProductsTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_redeem_products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_4498603')->references('id')->on('products');
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id', 'variant_fk_4649628')->references('id')->on('product_variants');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4498604')->references('id')->on('users');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id', 'address_fk_4498611')->references('id')->on('address_books');
            $table->unsignedBigInteger('shipped_by_id')->nullable();
            $table->foreign('shipped_by_id', 'shipped_by_fk_4498612')->references('id')->on('admins');
            $table->unsignedBigInteger('picked_up_by_id')->nullable();
            $table->foreign('picked_up_by_id', 'picked_up_by_fk_4666061')->references('id')->on('admins');
            $table->unsignedBigInteger('completed_by_id')->nullable();
            $table->foreign('completed_by_id', 'completed_by_fk_4498613')->references('id')->on('admins');
            $table->unsignedBigInteger('refund_by_id')->nullable();
            $table->foreign('refund_by_id', 'refund_by_fk_4498614')->references('id')->on('admins');
            $table->unsignedBigInteger('shipping_company_id')->nullable();
            $table->foreign('shipping_company_id', 'shipping_company_fk_4498636')->references('id')->on('shipping_companies');
        });
    }
}
