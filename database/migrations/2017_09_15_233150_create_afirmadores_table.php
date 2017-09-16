<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfirmadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afirmadores', function (Blueprint $table) {
            $table->increments('id');
             $table->string('nombreAfirmador')->unique();
            $table->integer('id_enlace')->unsigned();

            $table->foreign('id_enlace')->references('id')->on('enlaces')->onDelete('no action');
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
        Schema::dropIfExists('afirmadores');
    }
}
