<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logs extends Migration
{

    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('action_type');
            $table->integer('user_type');
            $table->string('status_code');
            $table->timestamps();

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
