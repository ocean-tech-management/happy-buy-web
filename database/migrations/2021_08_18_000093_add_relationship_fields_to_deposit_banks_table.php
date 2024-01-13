<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDepositBanksTable extends Migration
{
    public function up()
    {
        Schema::table('deposit_banks', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id', 'bank_fk_4670489')->references('id')->on('bank_lists');
        });
    }
}
