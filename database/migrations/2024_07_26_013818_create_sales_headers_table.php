<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_headers', function (Blueprint $table) {
            $table->string('member_no')->nullable();
            $table->string('number', 15)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('store_code', 3)->nullable();
            $table->integer('pos')->nullable();
            $table->integer('trans')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('file_name', 30)->nullable();
            $table->index('member_no', 'sales_headers_member_no');
            $table->index('number', 'sales_headers_number');
            $table->index('tanggal', 'sales_headers_tanggal');
            $table->index('store_code', 'sales_headers_store_code');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_headers');
    }
}
