<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('user_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_type');
            $table->string('deposit');
            $table->string('fee');
            $table->string('top_up');
            $table->string('invoice_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('new_invoice_number')->nullable();
            $table->string('new_receipt_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
