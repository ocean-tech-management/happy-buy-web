<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name_en')->nullable();
            $table->string('product_name_zh')->nullable();
            $table->longText('short_desc_en')->nullable();
            $table->longText('short_desc_zh')->nullable();
            $table->longText('product_desc_en')->nullable();
            $table->longText('product_desc_zh')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('merchant_president_price')->nullable();
            $table->string('agent_director_price')->nullable();
            $table->string('agent_executive_price')->nullable();
            $table->string('vip_redeem_pv')->nullable();
            $table->string('price_add_on')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
