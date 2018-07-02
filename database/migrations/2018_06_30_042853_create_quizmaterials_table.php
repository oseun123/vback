<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizmaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizmaterials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('image');
            $table->string('locations');
            $table->string('size');
            $table->string('lifespan');
            $table->string('diet');
            $table->text('description');
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
        Schema::dropIfExists('quizmaterials');
    }
}
