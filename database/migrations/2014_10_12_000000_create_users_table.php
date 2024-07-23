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
            $table->id();
            $table->string('full_name',255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password', 60)->nullable();
            $table->integer('role_id')->nullable();
            $table->string('store_code', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->smallInteger('is_suspend')->default('0')->nullable();
            $table->smallInteger('is_disabled')->default('0')->nullable();
            $table->integer('created_by')->default('0')->nullable();
            $table->integer('upated_by')->default('0')->nullable();
            $table->timestamp('created_at')->default(DB::raw('now()'))->nullable();
            $table->timestamp('updated_at')->default(DB::raw('now()'))->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
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
