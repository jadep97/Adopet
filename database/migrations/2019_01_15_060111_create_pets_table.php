<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id')->primarykey();
            $table->string('petName');
						$table->string('breed')->nullable();
            $table->string('petOwner');
            $table->string('petBirth')->nullable();
            $table->string('address');
						$table->string('description')->nullable();
						$table->boolean('isPosted')->nullable();
						$table->string('petImg');
						$table->unsignedInteger('user_id');
				    $table->timestamps();

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
        Schema::dropIfExists('pets');
    }
}
