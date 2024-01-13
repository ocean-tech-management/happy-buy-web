<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('user_type')->nullable();
            $table->string('personal_code')->nullable();
            $table->string('status')->nullable();
            $table->string('account_verify')->nullable();
            $table->string('ssm_verify')->nullable();
            $table->string('shop_verify')->nullable();
            $table->string('first_payment')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
