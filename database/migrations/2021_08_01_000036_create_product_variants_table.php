<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->nullable();
            $table->integer('stock')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('merchant_president_price')->nullable();
            $table->string('agent_director_price')->nullable();
            $table->string('agent_executive_price')->nullable();
            $table->string('vip_redeem_pv')->nullable();
            $table->string('price_add_on')->nullable();
            $table->integer('qr_quantity')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
