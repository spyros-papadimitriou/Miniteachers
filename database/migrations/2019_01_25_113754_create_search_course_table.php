<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_course', function (Blueprint $table) {
            $table->unsignedInteger('id_search');
            $table->unsignedInteger('id_course');
            $table->primary(array('id_search', 'id_course'));
            $table->foreign('id_search')->references('id')->on('search')->onDelete('cascade');
            $table->foreign('id_course')->references('id')->on('course')->onDelete('cascade');
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
        Schema::dropIfExists('search_course');
    }
}
