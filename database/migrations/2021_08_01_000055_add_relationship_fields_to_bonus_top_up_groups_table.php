<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBonusTopUpGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('bonus_top_up_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('point_package_id');
            $table->foreign('point_package_id', 'point_package_fk_4749704')->references('id')->on('point_packages');
        });
    }
}
