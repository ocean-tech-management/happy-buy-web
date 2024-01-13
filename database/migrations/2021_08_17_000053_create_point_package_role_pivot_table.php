<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointPackageRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('point_package_role', function (Blueprint $table) {
            $table->unsignedBigInteger('point_package_id');
            $table->foreign('point_package_id', 'point_package_id_fk_4649039')->references('id')->on('point_packages')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_4649039')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
