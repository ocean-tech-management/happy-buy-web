<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_4567096')->references('id')->on('products');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id', 'color_fk_4567110')->references('id')->on('product_colors');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id', 'size_fk_4567599')->references('id')->on('product_sizes');
        });
    }
}
