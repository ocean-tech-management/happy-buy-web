<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_4684328')->references('id')->on('products');
            $table->unsignedBigInteger('product_variant_id');
            $table->foreign('product_variant_id', 'product_variant_fk_4747039')->references('id')->on('product_variants');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_fk_4626285')->references('id')->on('orders');
        });
    }
}
