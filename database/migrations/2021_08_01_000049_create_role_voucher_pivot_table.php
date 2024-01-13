<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleVoucherPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_voucher', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id', 'voucher_id_fk_4496152')->references('id')->on('vouchers')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_4496152')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
