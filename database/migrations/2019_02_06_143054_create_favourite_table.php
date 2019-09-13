<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite', function (Blueprint $table) {
            $table->unsignedInteger('id_user_from');
            $table->unsignedInteger('id_user_to');
            $table->primary(array('id_user_from', 'id_user_to'));
            $table->foreign('id_user_from')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_user_to')->references('id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourite');
    }
}
