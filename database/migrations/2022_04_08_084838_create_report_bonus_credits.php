<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportBonusCredits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_bonus_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('transaction_date')->nullable();
            // $table->string('document_no')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('amount')->nullable();
            $table->string('total')->nullable();
            $table->string('from_table')->nullable();
            $table->bigInteger('from_table_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_bonus_credits');
    }
}
