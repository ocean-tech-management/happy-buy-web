<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpLogsTable extends Migration
{
    public function up()
    {
        Schema::create('otp_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->string('code');
            $table->longText('content');
            $table->string('status')->nullable();
            $table->longText('api_response')->nullable();
            $table->datetime('used_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
