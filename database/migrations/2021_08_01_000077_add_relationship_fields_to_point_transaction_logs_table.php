<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPointTransactionLogsTable extends Migration
{
    public function up()
    {
        Schema::table('point_transaction_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4505874')->references('id')->on('users');
        });
    }
}
