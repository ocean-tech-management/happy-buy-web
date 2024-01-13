<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserAgreementLogsTable extends Migration
{
    public function up()
    {
        Schema::table('user_agreement_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_agreement_id');
            $table->foreign('user_agreement_id', 'user_agreement_fk_4764751')->references('id')->on('user_agreements');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4764752')->references('id')->on('users');
        });
    }
}
