<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stat', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('user');
            $table->unsignedInteger('id_experience');
            $table->foreign('id_experience')->references('id')->on('experience');
            $table->unsignedInteger('id_level');
            $table->foreign('id_level')->references('id')->on('level');
            $table->unsignedInteger('price_per_hour')->nullable();
            $table->unsignedInteger('todays_views')->default(0);
            $table->unsignedInteger('total_views')->default(0);
            $table->unsignedInteger('points')->default(0);
            $table->boolean('published');
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
        Schema::dropIfExists('user_stat');
    }
}
