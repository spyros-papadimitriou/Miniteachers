<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_website', function (Blueprint $table) {
            $table->unsignedInteger('id_search');
            $table->unsignedInteger('id_website');
            $table->primary(array('id_search', 'id_website'));
            $table->foreign('id_search')->references('id')->on('search')->onDelete('cascade');
            $table->foreign('id_website')->references('id')->on('website')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_website');
    }
}
