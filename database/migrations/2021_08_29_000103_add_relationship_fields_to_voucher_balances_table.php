<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVoucherBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('voucher_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4749117')->references('id')->on('users');
        });
    }
}
