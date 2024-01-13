<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusJoinsTable extends Migration
{
    public function up()
    {
        Schema::create('bonus_joins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('first_upline_bonus', 15, 2);
            $table->float('second_upline_bonus', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
