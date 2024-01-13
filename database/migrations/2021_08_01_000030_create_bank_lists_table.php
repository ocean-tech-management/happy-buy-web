<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankListsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('bank_name');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
