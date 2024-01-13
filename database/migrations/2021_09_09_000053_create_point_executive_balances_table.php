<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointExecutiveBalancesTable extends Migration
{
    public function up()
    {
        Schema::create('point_executive_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amount');
            $table->string('status')->nullable();
            $table->string('settlement')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
