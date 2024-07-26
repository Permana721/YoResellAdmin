<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_members', function (Blueprint $table) {
            $table->string('fullname', 200)->nullable();
            $table->string('mobile_no', 30)->nullable();
            $table->string('card_code', 30)->nullable();
            $table->string('customer_code', 200)->nullable();
            $table->index('card_code');
            $table->index('customer_code');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_members');
    }
}
