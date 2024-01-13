<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutLimitsTable extends Migration
{
    public function up()
    {
        Schema::create('payout_limits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('min_amount', 15, 2)->nullable();
            $table->decimal('max_amount', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
