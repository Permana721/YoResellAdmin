<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id');
            $table->bigInteger('menu_id');
            $table->smallInteger('c')->default(0);
            $table->smallInteger('r')->default(0);
            $table->smallInteger('u')->default(0);
            $table->smallInteger('d')->default(0);
            $table->index(['role_id', 'menu_id']);
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
}
