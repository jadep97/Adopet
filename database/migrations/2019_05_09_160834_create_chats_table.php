<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id')->primarykey();
						$table->unsignedInteger('pet_id');
						$table->unsignedInteger('petOwner');
						$table->unsignedInteger('petAdopter');
            $table->timestamps();

						$table->foreign('pet_id')
												->references('id')->on('pets')
												->onUpdate('cascade');
						$table->foreign('petOwner')
												->references('id')->on('users')
												->onUpdate('cascade');
						$table->foreign('petAdopter')
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
        Schema::dropIfExists('chats');
    }
}
