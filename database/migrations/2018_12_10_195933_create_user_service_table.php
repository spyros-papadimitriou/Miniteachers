<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserServiceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_service', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_service');
            $table->primary(array('id_user', 'id_service'));
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_service')->references('id')->on('service')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_service');
    }

}
