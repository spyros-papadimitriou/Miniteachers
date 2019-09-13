<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWebsiteTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_website', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_website');
            $table->primary(array('id_user', 'id_website'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_website')->references('id')->on('website');
            $table->string('value', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_website');
    }

}
