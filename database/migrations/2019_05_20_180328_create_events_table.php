<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->date('date');
            $table->time('time');
            $table->text('Buy_url');

            $table->string('local_name',75)->nulable();
            $table->string('street',75);
            $table->string('complement',75)->nullable();
            $table->string('neighborhood',75);
            $table->string('city',75);
            $table->string('state',75);

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
        Schema::dropIfExists('events');
    }
}
