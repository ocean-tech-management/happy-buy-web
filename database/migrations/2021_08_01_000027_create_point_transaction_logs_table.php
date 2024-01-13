<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTransactionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('point_transaction_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('top_up');
            $table->string('point_convert')->nullable();
            $table->string('redemption');
            $table->string('shipping');
            $table->string('cash_voucher');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
