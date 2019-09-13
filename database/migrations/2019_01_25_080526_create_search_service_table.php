<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_service', function (Blueprint $table) {
            $table->unsignedInteger('id_search');
            $table->unsignedInteger('id_service');
            $table->primary(array('id_search', 'id_service'));
            $table->foreign('id_search')->references('id')->on('search')->onDelete('cascade');
            $table->foreign('id_service')->references('id')->on('service')->onDelete('cascade');
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
        Schema::dropIfExists('search_service');
    }
}
