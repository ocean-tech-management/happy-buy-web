<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionBonusGivensTable extends Migration
{
    public function up()
    {
        Schema::create('transaction_bonus_givens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction')->nullable();
            $table->string('title')->nullable();
            $table->string('remark')->nullable();
            $table->float('amount', 15, 2)->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->datetime('given_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
