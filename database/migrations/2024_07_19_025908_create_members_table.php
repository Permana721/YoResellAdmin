<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('password', 150)->nullable();
            $table->string('otp', 6)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->string('address', 255)->nullable();
            $table->integer('zipcode_id')->nullable();
            $table->string('phone1', 50)->nullable();
            $table->string('phone2', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('nric_type_id')->nullable();
            $table->string('nric', 50)->nullable();
            $table->string('store_code', 5)->nullable();
            $table->integer('total_points')->default('0')->nullable();
            $table->integer('total_undians')->default('0')->nullable();
            $table->date('registered_at')->default('2016-01-01')->nullable();
            $table->date('first_logged_in_at')->default('2016-01-01')->nullable();
            $table->integer('question_1')->nullable();
            $table->integer('question_2')->nullable();
            $table->string('answer_1', 255)->nullable();
            $table->string('answer_2', 255)->nullable();
            $table->string('is_blocked', 5)->default('0')->nullable();
            $table->integer('created_by')->default('1')->nullable();
            $table->integer('updated_by')->default('1')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('favourite_stores')->nullable();
            $table->string('store_site_code_sales')->nullable();
            $table->string('password_md5')->nullable();
            $table->integer('total_tokens')->default('0')->nullable();
            $table->string('keterangan')->nullable();
            $table->smallInteger('approve_cso')->default('0');
            $table->smallInteger('approve_admin')->default('0');
            $table->timestamp('approve_cso_at')->default(DB::raw('now()'))->nullable();
            $table->timestamp('approve_admin_at')->default(DB::raw('now()'))->nullable();
            $table->smallInteger('approve_cso_by')->nullable();
            $table->smallInteger('approve_admin_by')->nullable();
            $table->string('tokopedia')->nullable();
            $table->string('shopee')->nullable();
            $table->string('bukalapak')->nullable();
            $table->string('lain-lain')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('photo')->nullable();
            $table->string('type_costumer', 100)->nullable();
            $table->string('brand', 200)->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
