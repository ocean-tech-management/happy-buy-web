<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total_add_on')->nullable();
            $table->string('total_shipping')->nullable();
            $table->string('voucher_amount')->nullable();
            $table->string('cash_voucher_amount')->nullable();
            $table->string('wallet_type')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_address_1')->nullable();
            $table->string('receiver_address_2')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('receiver_postcode')->nullable();
            $table->string('pre_point_balance')->nullable();
            $table->string('post_point_balance')->nullable();
            $table->string('collect_type')->nullable();
            $table->string('tracking_code')->nullable();
            $table->datetime('shipout_at')->nullable();
            $table->datetime('pickup_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->datetime('refund_at')->nullable();
            $table->string('status')->nullable();
            $table->longText('remark')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('new_invoice_number')->nullable();
            $table->integer('shipping_invoice_user_id')->nullable();
            $table->string('credit_note_number')->nullable();
            $table->string('shipping_invoice_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
