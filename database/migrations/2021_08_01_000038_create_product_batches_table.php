<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBatchesTable extends Migration
{
    public function up()
    {
        Schema::create('product_batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('remark')->nullable();
            $table->string('status')->nullable();
            $table->string('quantity');
            $table->datetime('generated_at')->nullable();
            $table->datetime('in_stock_at')->nullable();
            $table->string('cost_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
