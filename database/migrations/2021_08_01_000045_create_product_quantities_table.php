<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQuantitiesTable extends Migration
{
    public function up()
    {
        Schema::create('product_quantities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->string('qr_code')->nullable();
            $table->datetime('qr_generate_at')->nullable();
            $table->datetime('in_stock_at')->nullable();
            $table->datetime('sold_at')->nullable();
            $table->time('first_scan_at')->nullable();
            $table->string('cost_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
