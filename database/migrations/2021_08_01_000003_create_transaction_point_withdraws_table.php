<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPointWithdrawsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_point_withdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->float('amount', 15, 2)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('status')->nullable();
            $table->longText('remark')->nullable();
            $table->string('payment_voucher_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
