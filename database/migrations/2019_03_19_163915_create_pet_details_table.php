<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_details', function (Blueprint $table) {
            $table->increments('id')->primarykey();
            $table->string('eyes');
            $table->string('ears');
            $table->string('hair');
            $table->string('tail');
            $table->string('color');
            $table->string('marking');
            $table->string('size');
            $table->integer('pet_id')->unsigned();
            $table->timestamps();

            $table->foreign('pet_id')
                        ->references('id')->on('pets')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pet_details');
    }
}
