<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionShippingPurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_shipping_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->float('point', 15, 2)->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->datetime('payment_verified_at')->nullable();
            $table->longText('gateway_response')->nullable();
            $table->string('gateway_status')->nullable();
            $table->string('gateway_transaction')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
