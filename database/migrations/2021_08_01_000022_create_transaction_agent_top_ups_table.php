<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionAgentTopUpsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_agent_top_ups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('from_wallet')->nullable();
            $table->string('to_wallet')->nullable();
            $table->string('deposit_bank')->nullable();
            $table->string('deposit_bank_account_name')->nullable();
            $table->string('deposit_bank_account_number')->nullable();
            $table->string('merchant_pre_balance')->nullable();
            $table->string('merchant_post_balance')->nullable();
            $table->string('user_pre_balance')->nullable();
            $table->string('user_post_balance')->nullable();
            $table->string('status')->nullable();
            $table->datetime('approved_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
