<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionRedeemProductsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_redeem_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->string('product_name')->nullable();
            $table->float('purchase_price', 15, 2)->nullable();
            $table->string('purchase_color')->nullable();
            $table->string('purchase_size')->nullable();
            $table->string('purchase_quantity')->nullable();
            $table->float('pre_point_balance', 15, 2)->nullable();
            $table->string('post_point_balance')->nullable();
            $table->string('status')->nullable();
            $table->string('collect_type')->nullable();
            $table->string('tracking_code')->nullable();
            $table->datetime('refund_at')->nullable();
            $table->datetime('pickup_at')->nullable();
            $table->datetime('shipout_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
