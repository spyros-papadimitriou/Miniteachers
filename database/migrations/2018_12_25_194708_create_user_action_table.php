<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_action', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_action');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_action')->references('id')->on('action');
            $table->unsignedInteger('id_other_user')->nullable();
            $table->foreign('id_other_user')->references('id')->on('user')->onDelete('set null');
            $table->unsignedInteger('id_achievement')->nullable();
            $table->foreign('id_achievement')->references('id')->on('achievement')->onDelete('set null');
            $table->unsignedInteger('points')->default(0);
            $table->string('ip', 15);
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
        Schema::dropIfExists('user_action');
    }

}
