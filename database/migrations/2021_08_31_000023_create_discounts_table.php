<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->float('percent', 15, 2);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
