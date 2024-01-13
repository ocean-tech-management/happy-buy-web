<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_list_id')->nullable();
            $table->foreign('bank_list_id', 'bank_list_fk_4495224')->references('id')->on('bank_lists');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_4495196')->references('id')->on('countries');
            $table->unsignedBigInteger('direct_upline_id')->nullable();
            $table->foreign('direct_upline_id', 'direct_upline_fk_4764338')->references('id')->on('users');
            $table->unsignedBigInteger('upline_user_id')->nullable();
            $table->foreign('upline_user_id', 'upline_user_fk_4495252')->references('id')->on('users');
            $table->unsignedBigInteger('upline_user_1_id')->nullable();
            $table->foreign('upline_user_1_id', 'upline_user_1_fk_4495253')->references('id')->on('users');
            $table->unsignedBigInteger('upline_user_2_id')->nullable();
            $table->foreign('upline_user_2_id', 'upline_user_2_fk_4548812')->references('id')->on('users');
        });
    }
}
