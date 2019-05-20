<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name',35);
            $table->date('launch_date');
            $table->string('recorder',50)->nullable();
            $table->text('buy_url')->nullable();
            $table->string('genre',100)->nullable();

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
        Schema::dropIfExists('albums');
    }
}
