<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTargetGroupTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_target_group', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_target_group');
            $table->primary(array('id_user', 'id_target_group'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_target_group')->references('id')->on('target_group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_target_group');
    }

}
