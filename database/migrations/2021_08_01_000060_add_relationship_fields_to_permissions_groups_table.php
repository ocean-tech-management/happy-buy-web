<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPermissionsGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('permissions_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_4498998')->references('id')->on('permissions_groups');
        });
    }
}
