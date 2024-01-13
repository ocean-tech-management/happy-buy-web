<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanLogsTable extends Migration
{
    public function up()
    {
        Schema::create('scan_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
