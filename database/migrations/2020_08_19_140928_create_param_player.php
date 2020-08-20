<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('param_player', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('player_id')->unsigned();
            $table->bigInteger('param_id')->unsigned();
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            //$table->datetime('email_verified_at')->nullable();
            $table->foreign('param_id')->references('id')->on('params')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('param_player');
    }
}
