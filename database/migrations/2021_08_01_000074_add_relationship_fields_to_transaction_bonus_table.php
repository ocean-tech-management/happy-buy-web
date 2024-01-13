<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionBonusTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_bonus', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id', 'admin_fk_4498658')->references('id')->on('admins');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4498659')->references('id')->on('users');
        });
    }
}
