<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('school', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_institution');
            $table->foreign('id_institution')->references('id')->on('institution');
            $table->string('name', 128);
            $table->string('url', 128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('school');
    }

}
