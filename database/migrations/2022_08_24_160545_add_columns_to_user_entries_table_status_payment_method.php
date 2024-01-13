<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserEntriesTableStatusPaymentMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_entries', function (Blueprint $table) {
            $table->string('transaction')->nullable()->after('id');
            $table->unsignedBigInteger('payment_method_id')->nullable()->after('top_up');
            $table->string('status')->nullable()->after('payment_method_id');
            $table->datetime('payment_verified_at')->nullable()->after('status');
            $table->longText('gateway_response')->nullable()->after('payment_verified_at');
            $table->string('gateway_status')->nullable()->after('gateway_response');
            $table->string('gateway_transaction')->nullable()->after('gateway_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_entries_table_status_payment_method', function (Blueprint $table) {
            //
        });
    }
}
