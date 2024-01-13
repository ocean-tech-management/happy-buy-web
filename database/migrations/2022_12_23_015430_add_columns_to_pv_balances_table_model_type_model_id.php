<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPvBalancesTableModelTypeModelId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pv_balances', function (Blueprint $table) {
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
        Schema::table('pv_balances_table_model_type_model_id', function (Blueprint $table) {
            //
        });
    }
}
