<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMunicipalityTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_municipality', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_municipality');
            $table->primary(array('id_user', 'id_municipality'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_municipality')->references('id')->on('municipality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_municipality');
    }

}
