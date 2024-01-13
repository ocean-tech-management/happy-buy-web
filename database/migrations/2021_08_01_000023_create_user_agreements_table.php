<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAgreementsTable extends Migration
{
    public function up()
    {
        Schema::create('user_agreements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('agreement_content');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
