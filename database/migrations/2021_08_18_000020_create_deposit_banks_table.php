<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositBanksTable extends Migration
{
    public function up()
    {
        Schema::create('deposit_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
