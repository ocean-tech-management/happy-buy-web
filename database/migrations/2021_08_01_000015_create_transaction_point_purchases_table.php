<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPointPurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_point_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->float('point', 15, 2)->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->string('deposit')->nullable();
            $table->string('fee')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->datetime('payment_verified_at')->nullable();
            $table->longText('gateway_response')->nullable();
            $table->string('gateway_status')->nullable();
            $table->string('gateway_transaction')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('new_invoice_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('payment_voucher_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
