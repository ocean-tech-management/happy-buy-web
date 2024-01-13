<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCashVoucherBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('cash_voucher_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5692108')->references('id')->on('users');
        });
    }
}
