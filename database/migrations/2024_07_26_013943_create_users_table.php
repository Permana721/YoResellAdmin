<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password', 60)->nullable();
            $table->integer('role_id')->nullable();
            $table->string('store_code', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->smallInteger('is_suspended')->nullable()->default(0);
            $table->smallInteger('is_disabled')->nullable()->default(0);
            $table->integer('created_by')->nullable()->default(1);
            $table->integer('updated_by')->nullable()->default(1);
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->foreign('store_code')->references('store_code')->on('stores')->onDelete('cascade');
            $table->foreign('role_id')->references('roles')->on('id')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
