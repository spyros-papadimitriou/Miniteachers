<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchAdjective extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('search_adjective', function (Blueprint $table) {
            $table->unsignedInteger('id_search');
            $table->unsignedInteger('id_adjective');
            $table->primary(array('id_search', 'id_adjective'));
            $table->foreign('id_search')->references('id')->on('search')->onDelete('cascade');
            $table->foreign('id_adjective')->references('id')->on('adjective')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('search_adjective');
    }

}
