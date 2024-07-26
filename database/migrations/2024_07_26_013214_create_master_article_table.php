<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_article', function (Blueprint $table) {
            $table->string('article_code', 20)->nullable();
            $table->string('till_code', 20)->nullable();
            $table->string('article_desc', 200)->nullable();
            $table->string('art_type_system', 10)->nullable();
            $table->string('div', 3)->nullable();
            $table->string('div_desc', 40)->nullable();
            $table->string('subcat', 3)->nullable();
            $table->string('subcat_desc', 50)->nullable();
            $table->string('cat', 3)->nullable();
            $table->string('cat_desc', 50)->nullable();
            $table->string('family', 20);
            $table->timestamp('sync_at')->nullable();
            $table->index('article_code');
            $table->index('till_code');
            $table->index('art_type_system');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_article');
    }
}
