<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_title_1')->nullable();
            $table->string('file_title_2')->nullable();
            $table->string('file_title_3')->nullable();
            $table->string('file_title_4')->nullable();
            $table->string('file_title_5')->nullable();
            $table->integer('publish_year')->nullable();
            $table->integer('publish_month')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
