<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('announcement_role', function (Blueprint $table) {
            $table->unsignedBigInteger('announcement_id');
            $table->foreign('announcement_id', 'announcement_id_fk_4649030')->references('id')->on('announcements')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_4649030')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
