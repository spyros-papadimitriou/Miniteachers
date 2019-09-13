<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user_type');
            $table->foreign('id_user_type')->references('id')->on('user_type');
            $table->unsignedInteger('id_gender');
            $table->foreign('id_gender')->references('id')->on('gender');
            $table->string('email', 64)->unique();
            $table->string('password', 64);
            $table->string('token', 64);
            $table->boolean('confirmed');
            $table->string('name', 64);
            $table->string('slug', 64)->nullable();
            $table->date('birthdate');
            $table->timestamp('login_date');
            $table->string('picture', 48);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user');
    }

}
