<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserAgreementsTable extends Migration
{
    public function up()
    {
        Schema::table('user_agreements', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_fk_4764358')->references('id')->on('roles');
        });
    }
}
