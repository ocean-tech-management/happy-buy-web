<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointExecutiveBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('point_executive_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4832843')->references('id')->on('users');
        });
    }
}
