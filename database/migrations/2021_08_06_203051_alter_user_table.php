<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('otp_code', 255)->nullable();
            $table->string('register_verify_at', 255)->nullable();
            $table->string('sign_agreement_at', 255)->nullable();
            $table->string('sign_agreement_name', 255)->nullable();
            $table->string('sign_agreement_identity', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
