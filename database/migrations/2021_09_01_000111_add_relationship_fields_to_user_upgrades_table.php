<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserUpgradesTable extends Migration
{
    public function up()
    {
        Schema::table('user_upgrades', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_4771361')->references('id')->on('users');
            $table->unsignedBigInteger('topup_transaction_id')->nullable();
            $table->foreign('topup_transaction_id', 'topup_transaction_fk_4781256')->references('id')->on('transaction_point_purchases');
            $table->unsignedBigInteger('upgrade_role_id');
            $table->foreign('upgrade_role_id', 'upgrade_role_fk_4771375')->references('id')->on('roles');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_4771374')->references('id')->on('payment_methods');
            $table->unsignedBigInteger('approved_by_user_id')->nullable();
            $table->foreign('approved_by_user_id', 'approved_by_user_fk_4771372')->references('id')->on('users');
            $table->unsignedBigInteger('approved_by_admin_id')->nullable();
            $table->foreign('approved_by_admin_id', 'approved_by_admin_fk_4771373')->references('id')->on('admins');
        });
    }
}
