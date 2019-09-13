<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjectiveTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('adjective', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_male', 24)->nullable();
            $table->string('name_female', 24)->nullable();
            $table->description('description_male', 255)->nullable();
            $table->description('description_female', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('adjective');
    }

}
