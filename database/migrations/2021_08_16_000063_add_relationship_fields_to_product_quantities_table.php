<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductQuantitiesTable extends Migration
{
    public function up()
    {
        Schema::table('product_quantities', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->foreign('batch_id', 'batch_fk_4495625')->references('id')->on('product_batches');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_4495624')->references('id')->on('products');
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->foreign('product_variant_id', 'product_variant_fk_4740792')->references('id')->on('product_variants');
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->foreign('order_item_id', 'order_item_fk_4740615')->references('id')->on('order_items');
            $table->unsignedBigInteger('sold_to_user_id')->nullable();
            $table->foreign('sold_to_user_id', 'sold_to_user_fk_4495628')->references('id')->on('users');
            $table->unsignedBigInteger('in_stock_by_id')->nullable();
            $table->foreign('in_stock_by_id', 'in_stock_by_fk_4798462')->references('id')->on('admins');
        });
    }
}
