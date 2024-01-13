<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionAgentTopUpsTable extends Migration
{
    public function up()
    {
        Schema::table('transaction_agent_top_ups', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4505826')->references('id')->on('users');
            $table->unsignedBigInteger('merchant_id')->nullable();
            $table->foreign('merchant_id', 'merchant_fk_4505827')->references('id')->on('users');
            $table->unsignedBigInteger('point_package_id')->nullable();
            $table->foreign('point_package_id', 'point_package_fk_4792185')->references('id')->on('point_packages');
        });
    }
}
