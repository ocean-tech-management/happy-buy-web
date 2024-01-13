<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('point_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_zh')->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->float('point', 15, 2)->nullable();
            $table->string('deduct_point')->nullable();
            $table->string('deduct_2_level_point')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
