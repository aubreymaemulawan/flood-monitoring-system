<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WaterLevel extends Migration
{

    public function up()
    {
        Schema::create('water_level', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->float('height');
            $table->string('color');
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
        Schema::dropIfExists('device');
    }
};
