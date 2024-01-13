<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPayoutLimitsTable extends Migration
{
    public function up()
    {
        Schema::table('payout_limits', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_4648746')->references('id')->on('roles');
        });
    }
}
