<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTableAddType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('type')->nullable()->after("desc_zh");
            $table->string('product_variant_quantity')->nullable()->after("type");
            $table->string('product_variant_item_quantity')->nullable()->after("product_variant_quantity");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_table_add_type', function (Blueprint $table) {
            //
        });
    }
}
