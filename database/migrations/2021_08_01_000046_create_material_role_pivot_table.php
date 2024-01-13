<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('material_role', function (Blueprint $table) {
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id', 'material_id_fk_4496148')->references('id')->on('materials')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_4496148')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
