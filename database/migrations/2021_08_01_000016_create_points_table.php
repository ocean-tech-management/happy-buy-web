<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('point_balance')->nullable();
            $table->string('point_manager_balance')->nullable();
            $table->string('point_executive_balance')->nullable();
            $table->string('point_bonus_balance')->nullable();
            $table->string('voucher_balance')->nullable();
            $table->string('voucher_log')->nullable();
            $table->string('shipping_balance')->nullable();
            $table->string('cash_voucher_balance')->nullable();
            $table->string('pv_balance')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
