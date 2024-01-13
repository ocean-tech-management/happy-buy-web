<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgreementLogsTable extends Migration
{
    public function up()
    {
        Schema::create('user_agreement_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('signature_name');
            $table->string('signature_ic');
            $table->datetime('signature_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
