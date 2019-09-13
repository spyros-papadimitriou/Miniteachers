<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMessageTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_message', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_message');
            $table->primary(array('id_user', 'id_message'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_message')->references('id')->on('message')->onDelete('cascade');
            $table->boolean('is_read')->default(0);
            $table->boolean('important')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_message');
    }

}
