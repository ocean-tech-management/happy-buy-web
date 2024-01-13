<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductQrLogsTable extends Migration
{
    public function up()
    {
        Schema::table('product_qr_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_4796076')->references('id')->on('products');
        });
    }
}
