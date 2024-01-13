<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointConvertsTable extends Migration
{
    public function up()
    {
        Schema::create('point_converts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->integer('amount');
            $table->string('pre_cp_bonus_balance')->nullable();
            $table->string('post_cp_bonus_balance')->nullable();
            $table->string('pre_cp_balance')->nullable();
            $table->string('post_cp_balance')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
