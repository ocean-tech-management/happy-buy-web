<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointBonusBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('point_bonus_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4669800')->references('id')->on('users');
        });
    }
}
