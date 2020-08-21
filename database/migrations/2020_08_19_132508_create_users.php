<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->index();
            //$table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->string('type')->default('default');
            $table->string('api_token')->unique()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    //$2y$10$QiasqqI.cDvsoTjlTcQU5e04arDDw4OwCvw9ZsBEsmZ1EOkbsi0Oe
    //Leonard	leonard77dam@yahoo.it	$2y$10$QiasqqI.cDvsoTjlTcQU5e04arDDw4OwCvw9ZsBEsmZ1EOkbsi0Oe	NULL	admin	2020-08-20 08:11:44	2020-08-20 08:11:44	NULL


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
