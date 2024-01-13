<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTransactionBonusGivensTableModelTypeModelId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_bonus_givens', function (Blueprint $table) {
            $table->string('model_type')->nullable()->after("remark");
            $table->string('model')->nullable()->after("remark");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_bonus_givens_table_model_type_model_id', function (Blueprint $table) {
            //
        });
    }
}
