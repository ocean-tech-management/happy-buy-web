<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusPersonalsTable extends Migration
{
    public function up()
    {
        Schema::create('bonus_personals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('point');
            $table->string('percent');
            $table->string('after_point');
            $table->string('after_percent');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
