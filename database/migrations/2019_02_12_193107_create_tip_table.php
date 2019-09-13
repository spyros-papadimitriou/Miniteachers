<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tip', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_agent')->nullable();
            $table->foreign('id_agent')->references('id')->on('agent')->onDelete('set null');
            $table->string('alias', 48)->unique();
            $table->string('title', 48);
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tip');
    }

}
