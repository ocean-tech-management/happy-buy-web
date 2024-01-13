<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUpgradesTable extends Migration
{
    public function up()
    {
        Schema::create('user_upgrades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amount');
            $table->string('status');
            $table->longText('gateway_response')->nullable();
            $table->string('gateway_status')->nullable();
            $table->string('gateway_transaction')->nullable();
            $table->datetime('approve_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
