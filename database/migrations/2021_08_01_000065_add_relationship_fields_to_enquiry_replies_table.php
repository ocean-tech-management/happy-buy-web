<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnquiryRepliesTable extends Migration
{
    public function up()
    {
        Schema::table('enquiry_replies', function (Blueprint $table) {
            $table->unsignedBigInteger('enquiry_id');
            $table->foreign('enquiry_id', 'enquiry_fk_4495827')->references('id')->on('enquiries');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id', 'admin_fk_4495828')->references('id')->on('admins');
        });
    }
}
