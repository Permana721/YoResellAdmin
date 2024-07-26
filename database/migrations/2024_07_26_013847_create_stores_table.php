<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('store_code', 3)->nullable();
            $table->string('initial_store', 255);
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->integer('region_code')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('longitude', 255)->nullable();
            $table->timestampTz('createdAt')->default(DB::raw("'2017-01-01 14:04:50+00'::timestamp with time zone"));
            $table->timestampTz('updatedAt')->default(DB::raw("'2017-01-01 14:04:50+00'::timestamp with time zone"));
            $table->integer('is_fnb')->nullable();
            $table->integer('is_fashion')->nullable();
            $table->integer('is_supermarket')->nullable();
            $table->integer('is_yogya_electronic')->nullable();
            $table->integer('is_food_court')->nullable();
            $table->string('open_hour', 255)->nullable();
            $table->text('store_image1')->nullable();
            $table->text('store_image2')->nullable();
            $table->text('store_image3')->nullable();
            $table->text('store_description')->nullable();
            $table->integer('is_active')->nullable()->default(1);
            $table->string('type_store')->nullable();
            $table->string('sm')->nullable();
            $table->unique('store_code', 'stores_store_code_uindex');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
