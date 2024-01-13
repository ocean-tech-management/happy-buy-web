<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWithdrawExcelsTable extends Migration
{
    public function up()
    {
        Schema::table('withdraw_excels', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id', 'admin_fk_4911906')->references('id')->on('admins');
        });
    }
}
