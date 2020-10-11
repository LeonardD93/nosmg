<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuilds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('boss_id')->unsigned();
            $table->bigInteger('vice1_id')->unsigned()->nullable();
            $table->bigInteger('vice2_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('boss_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('vice1_id')->references('id')->on('players')->onDelete('set null');
            $table->foreign('vice2_id')->references('id')->on('players')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guilds');
    }
}
