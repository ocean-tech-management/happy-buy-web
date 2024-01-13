<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4583721')->references('id')->on('users');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_4583637')->references('id')->on('products');
            $table->unsignedBigInteger('product_variant_id');
            $table->foreign('product_variant_id', 'product_variant_fk_4583698')->references('id')->on('product_variants');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id', 'address_fk_4583643')->references('id')->on('address_books');
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->foreign('to_user_id', 'to_user_fk_4583643')->references('id')->on('users');
        });
    }
}
