<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',35);
            $table->string('genre',100)->nullable();
            $table->integer('number')->nullable();

            $table->unsignedInteger('album_id')->nullable();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->unsignedInteger('band_id')->nullable();
            $table->foreign('band_id')->references('id')->on('bands')->onDelete('cascade');

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
        Schema::dropIfExists('musics');
    }
}
