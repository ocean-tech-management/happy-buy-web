<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToScanLogsTable extends Migration
{
    public function up()
    {
        Schema::table('scan_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->foreign('product_variant_id', 'product_variant_fk_5824295')->references('id')->on('product_variants');
        });
    }
}
