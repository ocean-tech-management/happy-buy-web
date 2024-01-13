<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductBatchesTable extends Migration
{
    public function up()
    {
        Schema::table('product_batches', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_4495561')->references('id')->on('products');
            $table->unsignedBigInteger('product_variant_id');
            $table->foreign('product_variant_id', 'product_variant_fk_4740324')->references('id')->on('product_variants');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4798335')->references('id')->on('admins');
            $table->unsignedBigInteger('in_stock_by_id')->nullable();
            $table->foreign('in_stock_by_id', 'in_stock_by_fk_4798336')->references('id')->on('admins');
        });
    }
}
