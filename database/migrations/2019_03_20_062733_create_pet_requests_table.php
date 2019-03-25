<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_requests', function (Blueprint $table) {
            $table->increments('id');
						$table->unsignedInteger('pet_id');
						$table->unsignedInteger('user_id');
						$table->timestamps();

						$table->foreign('pet_id')
												->references('id')->on('pets')
												->onUpdate('cascade');

						$table->foreign('user_id')
												->references('id')->on('users')
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
        Schema::dropIfExists('pet_request');
    }
}
