<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDepartmentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_department', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_department');
            $table->primary(array('id_user', 'id_department'));
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_department')->references('id')->on('department');
            $table->unsignedInteger('endyear')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_department');
    }

}
