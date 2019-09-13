<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCourseTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_course', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_course');
            $table->primary(array('id_user', 'id_course'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_course')->references('id')->on('course');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_course');
    }

}
