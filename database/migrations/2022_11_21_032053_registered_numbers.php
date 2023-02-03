<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisteredNumbers extends Migration
{

    public function up()
    {
        Schema::create('registered_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->bigInteger('contact_number');
            $table->timestamps();

            $table->foreign('device_id')
                    ->references('id')
                    ->on('device')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registered_numbers');
    }
};
