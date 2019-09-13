<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('search', function (Blueprint $table) {
            $table->increments('id');

            // Foreign keys
            $table->unsignedInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('user')->onDelete('set null');
            $table->unsignedInteger('id_user_type')->nullable();
            $table->foreign('id_user_type')->references('id')->on('user_type')->onDelete('set null');
            $table->unsignedInteger('id_gender')->nullable();
            $table->foreign('id_gender')->references('id')->on('gender')->onDelete('set null');
            $table->unsignedInteger('id_age_range')->nullable();
            $table->foreign('id_age_range')->references('id')->on('age_range')->onDelete('set null');
            $table->unsignedInteger('id_experience')->nullable();
            $table->foreign('id_experience')->references('id')->on('experience')->onDelete('set null');
            $table->unsignedInteger('id_municipality')->nullable();
            $table->foreign('id_municipality')->references('id')->on('municipality')->onDelete('set null');
            $table->unsignedInteger('id_regional_unit')->nullable();
            $table->foreign('id_regional_unit')->references('id')->on('regional_unit')->onDelete('set null');
            $table->unsignedInteger('id_target_group')->nullable();
            $table->foreign('id_target_group')->references('id')->on('target_group')->onDelete('set null');
            $table->unsignedInteger('id_course')->nullable();
            $table->foreign('id_course')->references('id')->on('course')->onDelete('set null');

            $table->string('name', 64);
            $table->unsignedInteger('price_from')->nullable();
            $table->unsignedInteger('price_to')->nullable();
            $table->boolean('postgraduate')->default(0);
            $table->boolean('phd')->default(0);
            $table->string('ip', 15);
            $table->unsignedInteger('page')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('search', function (Blueprint $table) {
            //
        });
    }

}
