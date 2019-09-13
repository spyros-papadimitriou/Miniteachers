<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_department', function (Blueprint $table) {
            $table->unsignedInteger('id_search');
            $table->unsignedInteger('id_department');
            $table->primary(array('id_search', 'id_department'));
            $table->foreign('id_search')->references('id')->on('search')->onDelete('cascade');
            $table->foreign('id_department')->references('id')->on('department')->onDelete('cascade');
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
        Schema::dropIfExists('search_department');
    }
}
