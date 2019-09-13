<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_school');
            $table->foreign('id_school')->references('id')->on('school');
            $table->string('name', 128);
            $table->string('url', 128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('department');
    }

}
