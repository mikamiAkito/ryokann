<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('posts_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->unique();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade')->unique();
            $table->string('reason', '500');
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
        Schema::dropIfExists('violation');
    }
}
