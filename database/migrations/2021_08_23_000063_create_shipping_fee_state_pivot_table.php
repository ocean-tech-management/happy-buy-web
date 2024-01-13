<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingFeeStatePivotTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_fee_state', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_fee_id');
            $table->foreign('shipping_fee_id', 'shipping_fee_id_fk_4705341')->references('id')->on('shipping_fees')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id', 'state_id_fk_4705341')->references('id')->on('states')->onDelete('cascade');
        });
    }
}
