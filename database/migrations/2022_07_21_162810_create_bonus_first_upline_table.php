<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusFirstUplineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_first_upline', function (Blueprint $table) {
            $table->id();
            $table->integer('referral_count')->nullable(); // Requirement to find downline
            $table->float('bonus_amount', 15, 2)->nullable(); 
            $table->float('extra_top_up_bonus', 15, 2)->nullable();
            $table->integer('top_up_count')->nullable(); // Requirement to top up
            $table->integer('days')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_first_upline');
    }
}
