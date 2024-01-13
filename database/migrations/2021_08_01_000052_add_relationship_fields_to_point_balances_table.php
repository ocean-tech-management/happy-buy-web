<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('point_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4499000')->references('id')->on('users');
        });
    }
}
