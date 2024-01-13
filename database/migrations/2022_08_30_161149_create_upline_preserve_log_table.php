<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUplinePreserveLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upline_preserve_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('direct_upline_id')->nullable();
            $table->bigInteger('upline_user_id')->nullable();
            $table->bigInteger('upline_user_1_id')->nullable();
            $table->bigInteger('upline_user_2_id')->nullable();
            $table->string('status')->nullable();
            $table->string('user_type')->nullable();
            $table->dateTime('referred_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upline_preserve_log');
    }
}
