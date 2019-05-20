<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('type');//0->photo 1->video
            $table->text('url');
            $table->boolean('is_profile');
            $table->text('file_name');
            $table->text('description',250)->nullable();

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
        Schema::dropIfExists('media');
    }
}
