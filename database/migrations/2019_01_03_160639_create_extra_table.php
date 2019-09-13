<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('extra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 128)->nullable();
            $table->unsignedInteger('id_user_type');
            $table->foreign('id_user_type')->references('id')->on('user_type')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('extra');
    }

}
