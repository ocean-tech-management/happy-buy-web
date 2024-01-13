<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPickUpLocationsTable extends Migration
{
    public function up()
    {
        Schema::table('pick_up_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_fk_4851171')->references('id')->on('countries');
        });
    }
}
