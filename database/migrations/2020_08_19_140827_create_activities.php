<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('organizer_id')->unsigned();
            $table->bigInteger('type_id')->unsigned();
            //$table->datetime('email_verified_at')->nullable();
            $table->date('start_date');
            $table->time('start_time');
            $table->integer('level_req');
            $table->integer('users_number');
            $table->string('other_req')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('organizer_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('activity_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
