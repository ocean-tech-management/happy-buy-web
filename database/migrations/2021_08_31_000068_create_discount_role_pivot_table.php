<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('discount_role', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id', 'discount_id_fk_4766400')->references('id')->on('discounts')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_4766400')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
