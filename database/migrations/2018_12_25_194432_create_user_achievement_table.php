<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAchievementTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_achievement', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_achievement');
            $table->primary(array('id_user', 'id_achievement'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_achievement')->references('id')->on('achievement');
            $table->string('comments', 128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_achievement');
    }

}
