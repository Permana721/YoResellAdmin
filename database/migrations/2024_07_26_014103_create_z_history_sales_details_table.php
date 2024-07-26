<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZHistorySalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_history_sales_details', function (Blueprint $table) {
            $table->date('tanggal');
            $table->string('store_code', 3);
            $table->integer('pos');
            $table->integer('trans');
            $table->string('plu', 15);
            $table->string('description', 250);
            $table->decimal('gross', 15, 2);
            $table->decimal('disc', 15, 2);
            $table->integer('qty');
            $table->string('file_name', 30);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('price', 15, 2)->nullable();
            $table->string('sku', 13)->nullable();
            $table->string('sv', 4)->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_history_sales_details');
    }
}
