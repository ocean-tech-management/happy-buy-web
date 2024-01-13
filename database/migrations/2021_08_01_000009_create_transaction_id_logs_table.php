<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionIdLogsTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_id_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
